<?php
// See the corresponding blog entries (in Polish):
// http://spiechu.pl/2012/05/16/tworzenie-pakietow-icmp-w-php
// http://spiechu.pl/2012/05/26/w-miare-bezpieczne-uruchamianie-skryptow-php-poprzez-shell_exec
class ICMPPing
{
    const TYPE_REQUEST = 0x08;
    const TYPE_RESPONSE = 0x00;
    const CODE = 0x00;
    const INITIAL_CHECKSUM = 0x00;
    const SEQ_NUM = 0x00;
    const DEFAULT_MSG = 'Default ping message';
    const PACKET_REQUEST_TEMPLATE = 'CCnnnA*';
    const PACKET_RESPOND_TEMPLATE = 'Ctype/Ccode/nchecksum/nuid/nseq/A*message';
    /**
     * Unique packet id
     *
     * @var integer
     */
    protected $_uid;
    /**
     * Raw socket
     *
     * @var resource
     */
    protected $_socket;
    /**
     * Current process user ID
     *
     * @var integer
     */
    protected $_userId;
    public function __construct()
    {
        // stash current user id and set to root
        // for object lifetime
        $this->_userId = posix_geteuid();
        posix_seteuid(0);
        $this->_socket = socket_create(
                AF_INET, SOCK_RAW, getprotobyname('icmp'));
        // set response timeout
        socket_set_option(
                $this->_socket, SOL_SOCKET, SO_RCVTIMEO, array(
            'sec' => 1,
            'usec' => 0));
    }
    /**
     * Sends ICMP echo request packet to the host provided in $destination
     * and returns response
     *
     * @param  string  $destination host
     * @param  string  $message     message to send
     * @param  integer $port        not needed actually
     * @return string  response from host
     */
    public function sendPacket($destination, $message = self::DEFAULT_MSG, $port = 0)
    {
        $packet = $this->getNewPacket($message);
        socket_sendto(
                $this->_socket, $packet, strlen($packet), 0, $destination, $port);
        $respond = 0;
        socket_recvfrom($this->_socket, $respond, 255, 0, $destination, $port);
        // strip IP header
        return substr($respond, 20);
    }
    /**
     * Constructs ICMP echo request packet
     *
     * @param  string $message message to send in packet
     * @return string packet
     */
    protected function getNewPacket($message)
    {
        $packet = pack(self::PACKET_REQUEST_TEMPLATE, self::TYPE_REQUEST, self::CODE, self::INITIAL_CHECKSUM, $this->getNewUid(), self::SEQ_NUM, $message);
        // there must be an even number of bytes in packet
        if (strlen($packet) % 2) {
            $packet .= ' ';
        }
        $checkSum = $this->computeChecksum($packet);
        // set 3rd and 4th byte to calculated checksum
        $packet[2] = $checkSum[0];
        $packet[3] = $checkSum[1];
        return $packet;
    }
    /**
     * Generates a new 2 bytes unique packet id
     *
     * @return integer
     */
    protected function getNewUid()
    {
        $this->_uid = rand(0x00, 0xFFFF);
        return $this->_uid;
    }
    /**
     * Calculates 16 bits so called 'internet' checksum
     *
     * @param  string  $packet
     * @return integer
     */
    protected function computeChecksum($packet)
    {
        // treat the whole packet as 16 bits unsigned short integers
        $seqPer16bits = unpack('n*', $packet);
        $sum = array_sum($seqPer16bits);
        // if there is a carry above 16 bit, add it at the beginning
        $sum = ($sum >> 16) + ($sum & 0xFFFF);
        // double check if there is no new carry after previous addition
        $sum += ($sum >> 16);
        // return 16 bits negate
        return pack('n', ~$sum);
    }
    /**
     * Unpacks the respond packet and checks type, uiq and checksum
     *
     * @param  string    $responsePacket respond packet
     * @return string    response message
     * @throws Exception when respose type, uniq or checksum is invalid
     */
    public function analyzeRespond($responsePacket)
    {
        $unpackedRespond = unpack(self::PACKET_RESPOND_TEMPLATE, $responsePacket);
        if ($unpackedRespond['type'] !== self::TYPE_RESPONSE) {
            throw new Exception('Bad response type');
        }
        if ($unpackedRespond['uid'] !== $this->_uid) {
            throw new Exception('Bad unique id');
        }
        // set 3rd and 4th checksum byte to 0x00
        // in order to calculate correct checksum
        $responsePacket[2] = pack('C', self::INITIAL_CHECKSUM);
        $responsePacket[3] = pack('C', self::INITIAL_CHECKSUM);
        if (pack('n*', $unpackedRespond['checksum']) !== $this->computeChecksum($responsePacket)) {
            throw new Exception('Bad checksum');
        }
        return $unpackedRespond['message'];
    }
    /**
     * Object life ends, so the root privileges end too
     */
    public function __desctruct()
    {
        posix_seteuid($this->_userId);
    }
}
class ICMPPingProcesser
{
    /**
     * @var string
     */
    protected $urlAddress;
    /**
     * @param string $urlAddress
     */
    public function __construct($urlAddress)
    {
        $this->urlAddress = $urlAddress;
    }
    /**
     * Returns 'Trying {$urlAddress}: PING RESPONSE: Everything OK'
     * when url address replied correctly
     *
     * @return string
     */
    public function ping()
    {
        try {
            $message = '';
            $urlToPing = $this->processUrl($this->urlAddress);
            if (!$this->isUrlExists($urlToPing)) {
                throw new Exception("{$urlToPing} doesn't exist!");
            }
            $icmp = new ICMPPing();
            $respond = $icmp->sendPacket($urlToPing, 'Everything OK');
            $message = "Trying {$urlToPing}: ";
            $message .= "PING RESPONSE: {$icmp->analyzeRespond($respond)}";
            return $message;
        } catch (Exception $e) {
            $message .= $e->getMessage();
            return $message;
        }
    }
    /**
     * Returns sanitized url host from param
     *
     * @param  string    $urlAddress
     * @return string    url host
     * @throws Exception when url address is not valid
     */
    protected function processUrl($urlAddress)
    {
        $sanitizedUrl = filter_var($urlAddress, FILTER_SANITIZE_URL);
        if ($sanitizedUrl === false || filter_var($sanitizedUrl, FILTER_VALIDATE_URL) === false) {
            throw new Exception("{$urlAddress} is not valid URL");
        }
        return parse_url($sanitizedUrl, PHP_URL_HOST);
    }
    /**
     * Checks if url address exists
     *
     * @param  string  $urlAddress
     * @return boolean
     */
    protected function isUrlExists($urlAddress)
    {
        if (gethostbyname($urlAddress) === $urlAddress) {
            return false;
        }
        return true;
    }
}
if (PHP_SAPI === 'cli' && isset($_SERVER['argv'][1])) {
    $pingProcesser = new ICMPPingProcesser($_SERVER['argv'][1]);
    echo $pingProcesser->ping();
} else {
    echo 'Not in cli mode or agument not set';
}
?>
