<?php
/**************************************************************************************************************

    NAME
        WMI.phpclass

    DESCRIPTION
        WMI interface for PHP.

    AUTHOR
        Christian Vigh, 11/2015.

    HISTORY
    [Version : 1.0]	[Date : 2014/11/14]     [Author : CV]
        Initial version.

    [Version : 1.1]	[Date : 2015/11/30]     [Author : CV]
	. Classes implemented on-the-fly now include underlying WMI object methods, which are dependent of the
	  WMI class being implemented.

    [Version : 1.1.1]	[Date : 2016/10/24]     [Author : CV]
	. The ArrayAccess interface of the WmiInstance class was incorrectly handled.

 **************************************************************************************************************/

/*==============================================================================================================

    WMI class -
        Wrapper around the WMI COM object.

  ==============================================================================================================*/
class      Wmi
   {
	// Underlying WMI object
	protected	$WmiObject ;


	/*--------------------------------------------------------------------------------------------------------------
	 
	    NAME
	        Constructor
	 
	    PROTOTYPE
	        $wmi	=  new WMI ( $wmi_object ) ;
		$wmi	=  new WMI ( $namespace ) ;
		$wmi	=  new WMI ( ) ;
	 
	    DESCRIPTION
	        Instanciates a WMI class which manages an underlying WMI object.
	 
	    PARAMETERS
	        $wmi_object (COM object) -
	                A COM instance of a winmgmts class.

		$namespace (string) -
			Windows management namespace. The default is :

				winmgmts:{impersonationLevel=Impersonate}!//./root/CIMV2
	 
	 *-------------------------------------------------------------------------------------------------------------*/
	public function  __construct ( $wmi_object_or_namespace = null )
	   {
		if  ( strncasecmp ( php_uname ( 's' ), 'windows', 7 ) )
			throw ( new \Exception ( "This class can only run on Windows platforms." ) ) ;

		if  ( $wmi_object_or_namespace  ===  null )
			$this -> WmiObject	=  new \COM ( 'winmgmts:{impersonationLevel=Impersonate}!//./root/CIMV2' ) ;
		else if  ( is_string ( $wmi_object_or_namespace ) )
			$this -> WmiObject	=  new \COM ( $wmi_object_or_namespace ) ;
		else
			$this -> WmiObject	=  $wmi_object_or_namespace ;
	    }

	
	/*--------------------------------------------------------------------------------------------------------------
	 
	    LocalInstance -
		Creates a WMI object instance on the local computer.     

	 *-------------------------------------------------------------------------------------------------------------*/
	public static function  LocalInstance ( $namespace = 'winmgmts:{impersonationLevel=Impersonate}!//./root/CIMV2' )
	   {
	        $wmi_object     =  new self ( new \COM ( $namespace ) ) ;
		
	        return ( $wmi_object ) ;
	    }
	
	
	/*--------------------------------------------------------------------------------------------------------------
	 
	    RemoteInstance -
		Creates a WMI object instance on the specified remote computer.     

	 *-------------------------------------------------------------------------------------------------------------*/
	public static function  RemoteInstance ( $computer, $user, $password, $namespace = 'root\CIMV2', $locale = null, $domain = null )
	   {
	        $locator	=  new \COM ( "WbemScripting.SWbemLocator" ) ;
	        $wmi_object     =  $locator -> ConnectServer ( $computer, $namespace, $user, $password, $locale, $domain ) ;
	        $wmi_object     =  new  self ( $wmi_object ) ;
		
	        return ( $wmi_object ) ;
	    }
	  

	/*--------------------------------------------------------------------------------------------------------------
	 
	    QueryInstances -
		A shortcut for :

			$wmi -> Query ( "SELECT * FROM $table" ) ;

	 *-------------------------------------------------------------------------------------------------------------*/
	public function  QueryInstances ( $table, $base_class = 'WmiInstance', $namespace = false )
	   {
		return ( $this -> Query ( "SELECT * FROM $table", $base_class, $namespace ) ) ;
	    }


	/*--------------------------------------------------------------------------------------------------------------
	 
	    NAME
	        Query - Queries WMI interface
	 
	    PROTOTYPE
	        $array	=  $wmi -> Query ( $query, $base_class = 'WmiInstance', $namespace = 'Wmi' ) ;
	 
	    DESCRIPTION
	        Performs a query on the Windows WMI interface and returns the results as an array of objects belonging
		to class $base_class.
	 
	    PARAMETERS
	        $query (string) -
	                Query for the WMI interface, eg :

				SELECT * FROM Win32_Process

		$base_class (string) -
			The Query() method creates a new class for the WMI table being queried. The new class will have
			the table name prepended with 'Wmi' ; for example, querying Win32_Process will return objects
			of class WmiWin32_Process, inheriting from $base_class which is, by default, the WmiInstance
			class.
			If you want to encapsulate the generated class, simply declare a new class inheriting from
			WmiInstance and specify its name to the Query() call.

		$namespace (string) -
			Indicates the namespace where new classes are to be created. An empty value means the current
			namespace.
	 
	    RETURN VALUE
	        Returns an array of Wmixxx objects, where "xxx" is the name of the WMI table being queried.
		An empty array is returned if the query returned no results.
	 
	 *-------------------------------------------------------------------------------------------------------------*/
	public function  Query ( $query, $base_class = 'WmiInstance', $namespace = false )
	   {
		if  ( ! preg_match ( '/FROM \s+ (?P<table> \w+)/imsx', $query, $match ) )
			throw ( new \Exception ( "The supplied query does not contain a FROM clause." ) ) ;

		$wmi_class		=  $match [ 'table' ] ;
		$full_class_path	=  $this -> __get_class_path ( $wmi_class, $namespace ) ;
		$class_exists		=  class_exists ( $full_class_path, false ) ;
		$rs			=  $this -> WmiObject -> ExecQuery ( $query ) ;
		$result			=  [] ;
		
		foreach  ( $rs  as  $row )
		   {
			if  ( ! $class_exists )
			   {
				$this -> __create_class ( $row, $wmi_class, $base_class, $namespace ) ;

				if  ( ! is_subclass_of ( $full_class_path, 'WmiInstance' ) )
					throw ( new \RuntimeException ( "Class \"$full_class_path\" should inherit from WmiInstance" ) ) ;

				$class_exists	=  true ;
			    }

			$result	[]	=  $this -> __get_instance ( $row, $full_class_path ) ;
		    }

		return ( $result ) ;
	    }


	/*--------------------------------------------------------------------------------------------------------------
	 
	    NAME
	       FromVariant - converts a Variant to PHP data.
	
	 *-------------------------------------------------------------------------------------------------------------*/
	public static function  FromVariant ( $variant ) 
	   {
		if  ( ! is_a ( $variant, "variant" ) )
			return ( $variant ) ;

		$variant_type	=  variant_get_type ( $variant ) ;		// Get variant type
		$is_array	=  ( $variant_type  &  VT_ARRAY ) ;		// Check if array
		$is_ref		=  ( $variant_type  &  VT_BYREF ) ;		// Check if reference (not used)
		$variant_type  &=  ~( VT_ARRAY | VT_BYREF ) ;			// Keep only basic type flags
		$items		=  array ( ) ;					// Return value
		
		// If variant is an array, get all array elements into a PHP array
		if  ( $is_array )
		   {
			foreach  ( $variant  as  $variant_item )
				$items []	=  $variant_item ;
		    }
		else
			$items []	=  $variant ;
		
		$item_count	=  count ( $items ) ;
		
		// Loop through array items (item count will be 1 if supplied variant is not an array)
		for  ( $i = 0 ; $i  <  $item_count ; $i ++ )
		   {
			$item	=  $items [$i] ;
			
			// Handle scalar types
			switch  ( $variant_type )
			   {
				case	VT_NULL :
					$items [$i]	=  null ;
					break ;
				
				case	VT_EMPTY :
					$items [$i]	=  false ;
					break ;
			
				case    VT_UI1 :	case	VT_UI2 :	case	VT_UI4 :	case	VT_UINT :
				case    VT_I1  :	case	VT_I2  :	case	VT_I4  :	case	VT_INT  :
					$items [$i]	=  ( integer ) $item ;
					break ;
				
				case	VT_R4 :
					$items [$i]	=  ( float ) $item ;
					break ;
				
				case	VT_R8 :
					$items [$i]	=  ( double ) $item ;
					break ;
					
				case	VT_BOOL :
					$items [$i]	=  ( boolean ) $item ;
					break ;
					
				case	VT_BSTR :
					$items [$i]	=  ( string )  $item ;
					break ;
					
				case    VT_VARIANT :
					if  ( $is_array )
						break ;
					else
						/* Intentionally fall through the default: case */ ;
				
				default :
					warning ( "Unexpected variant type $variant_type." ) ;
					$items [$i]	=  false ;
			    }
		    }
		
		return ( ( $is_array ) ?  $items : $items [0] ) ;
	    }

	/*--------------------------------------------------------------------------------------------------------------
	 
		Support functions.

	 *-------------------------------------------------------------------------------------------------------------*/

	// __create_class -
	//	Creates a class on-the-fly mapped to a query result.
	private function  __create_class ( $row, $class, $base, $namespace )
	   {
		$namespace	=  ( $namespace ) ?  "namespace $namespace ;" : '' ;
		$classtext	=  <<<END
$namespace

class  $class extends $base
   {
	public function  __construct ( \$row )
	   {
		parent::__construct ( \$row ) ;
	    }

END;
		$methods	=  [] ;


		foreach (  $row -> Methods_  as  $row_method )
		   {
			$method		=  
			   [ 
				'name'			=>  $row_method -> Name, 
				'parameters'		=>  [], 
				'has-result'		=>  false 
			    ] ;

			if  ( $row_method -> InParameters )
			   {
				foreach  ( $row_method -> InParameters -> Properties_  as  $parameter )
					$method [ 'parameters'    ] []	=  [ 'name' => $parameter -> Name, 'out' => false ] ;
			    }

			if  ( $row_method -> OutParameters )
			   {
				foreach  ( $row_method -> OutParameters -> Properties_  as  $parameter )
				   {
					if  (  ! strcasecmp ( $parameter -> Name, 'ReturnValue' ) )
						$method [ 'has-result' ]	=  true ;
					else
						$method [ 'parameters' ] []	=  [ 'name' => $parameter -> Name, 'out' => true ] ;
				    }
			    }

			$methods []	=  $method ;
		    }

		// Build method text
		foreach  ( $methods  as  $method )
		   {
			// Function header
			$classtext	.=  "\n\n\tpublic function  {$method [ 'name' ]} ( " ;

			// Function arguments
			$list	=  [] ;
			
			foreach  ( $method [ 'parameters' ]  as  $parameter )
			   {
				if  ( $parameter [ 'out' ] )
					$item	=  '&$' . $parameter [ 'name' ] ;
				else
					$item	=  '$' . $parameter [ 'name' ] ;

				$list []	=  $item ;
			    }

			$classtext	.=  implode ( ', ', $list ) . " )\n\t   {\n" ;

			// Create a variant for each OUT parameter
			foreach  ( $method [ 'parameters' ]  as  $parameter )
			   {
				if  ( $parameter [ 'out' ] )
					$classtext	.=  "\t\t\$vt_{$parameter [ 'name' ]}	=  new \VARIANT ( ) ;\n" ;
			    }

			// Call the underlying COM function
			$classtext		.=  "\n\t\t\$__result__	=  \$this -> WmiRow -> {$method [ 'name' ]} ( " ;
			$list		 =  [] ;

			foreach  ( $method [ 'parameters' ]  as  $parameter )
			   {
				if  ( $parameter [ 'out' ] )
					$item	=  '$vt_' . $parameter [ 'name' ] ;
				else
					$item	=  '$' . $parameter [ 'name' ] ;

				$list []	=  $item ;
			    }

			$classtext	.=  implode ( ', ', $list ) . " ) ;\n\n" ;

			// Convert OUT parameters from variant to PHP data
			foreach  ( $method [ 'parameters' ]  as  $parameter )
			   {
				if  ( $parameter [ 'out' ] )
					$classtext	.=  "\t\t\${$parameter [ 'name' ]}	= Wmi::FromVariant ( \$vt_{$parameter [ 'name' ]} ) ;\n" ;
			    }

			$classtext	.=  "\n" ;

			// If method returns a value then convert it
			if  ( $method [ 'has-result' ] )
				$classtext	.=  "\t\treturn ( Wmi::FromVariant ( \$__result__ ) ) ;\n" ;

			$classtext	.=  "\t    }\n" ;
		    }

		// Create the class
		$classtext	=  $classtext . "\n    }" ;
		eval ( $classtext ) ;
	    }


	// __get_class_path -
	//	Returns the full path of the specified class.
	private function  __get_class_path ( $class, $namespace )
	   {
		if  ( $namespace )
			return ( "$namespace\\$class" ) ;
		else
			return ( "$class" ) ;
	    }


	// __get_instance -
	//	Instanciate a query row using our brand new class.
	private function  __get_instance ( $wmi_row, $class )
	   {
		return ( new $class ( $wmi_row ) ) ;
	    }
    }


/*==============================================================================================================

    WmiInstance -
        Maps the properties of a row returned by a query to real class members.

  ==============================================================================================================*/
class  WmiInstance		implements	\ArrayAccess, \Countable, \Iterator
   {
	private		$PropertyNames ;
	protected	$WmiRow ;


	/*--------------------------------------------------------------------------------------------------------------

	    Constructor -
	        Instanciates a WmiInstance object using a data row returned by a Wmi query.
		After instanciation, all the properties of the data row become available as regular PHP object 
		properties.
		Properties are also accessible through iterators and array access.
	 
	 *-------------------------------------------------------------------------------------------------------------*/
	public function  __construct ( $wmi_row )
	   {
		$this -> WmiRow		=  $wmi_row ;

		foreach  ( $wmi_row -> Properties_  as  $property )
		   {
			$property_name 			=  $property -> Name ;
			
			// Property is an array : we have to extract each item from the underlying variant
			if  ( $property -> IsArray )
			   {
				$property_value	=  [] ;

				// ... but be careful to null or empty arrays
				if (  $property -> Value  !==  null  &&  variant_get_type ( $property -> Value )  !=  VT_NULL )
				   {
					foreach (  $property -> Value  as  $item )
						$property_value []	=  $this -> __normalize ( $item ) ;
				    }
			    }
			// Property should be a "standard" value, that can be mapped to one of the PHP base scalar types.
			else
				$property_value 	=  $this -> __normalize ( $property -> Value ) ;
				
			// Assign the property to this instance (either a scalar type or an array)
			$this -> $property_name 	=  $property_value ;
			
			// Add it to the list of dynamically defined properties
			$this -> PropertyNames []	=  $property_name ;
		    }

		$this -> PropertyNames	=  array_flip ( $this -> PropertyNames ) ;
	    }


	// __normalize -
	//	Try to guess the type of a property value.
	private function  __normalize ( $item )
	   {
		if  ( is_numeric ( $item ) )
		   {
			if  ( $item  ==  ( integer ) $item )
				$result		=  ( integer ) $item ;
			else
				$result		=  ( double ) $item ;
		    }
		else if  ( $item  ===  null )
			$result		=  null ;
		else if  ( ! strcasecmp ( $item, 'true' ) )
			$result		=  true ;
		else if  ( ! strcasecmp ( $item, 'false' ) )
			$result		=  false ;
		else
			$result		=  $item ;

		return ( $result ) ;
	    }


	/*--------------------------------------------------------------------------------------------------------------

	    ToArray -
	        Converts this object to an associative array of property name/value pairs.
	 
	 *-------------------------------------------------------------------------------------------------------------*/
	public function  ToArray ( )
	   {
		$result		=  [] ;

		foreach  ( $this -> PropertyNames  as  $name )
			$result [ $name ]	=  $this -> $name ;

		return ( $result ) ;
	    }


	/*--------------------------------------------------------------------------------------------------------------
	 
	        Countable interface implementation.
	 
	 *-------------------------------------------------------------------------------------------------------------*/
	public function  count ( )
	   { return ( count ( $this -> PropertyNames ) ) ; }
	
	
	/*--------------------------------------------------------------------------------------------------------------
	 
	        ArrayAccess interface implementation.
	 
	 *-------------------------------------------------------------------------------------------------------------*/
	private function  __offset_get ( $offset )
	   {
		if  ( is_integer ( $offset )  &&  $offset  >  0  &&  $offset  <  count ( $this -> PropertyNames ) )
			return ( $this -> PropertyNames [ $offset ] ) ;
		else if  ( is_string  ( $offset )  &&  isset  ( $this -> PropertyNames [ $offset ] ) )
			return ( $this -> $offset ) ;
		else
			return ( false ) ;
	    }
	
	
	public function  offsetExists ( $offset )
	   { return ( $this -> __offset_get ( $offset )  !==  false ) ; }
		
	
	public function  offsetGet ( $offset )
	   {
		$value	=  $this -> __offset_get ( $offset ) ;
		
		if  ( $value  !==  false )
			return ( $value ) ;
		else
			throw ( new \OutOfRangeException ( "Invalid offset $offset." ) ) ;
	    }

	
	public function  offsetSet ( $offset, $value ) 
	   { throw ( new \Exception ( "Unsupported operation.") ) ; }

	
	public function  offsetUnset ( $offset ) 
	   { throw ( new \Exception ( "Unsupported operation.") ) ; }
	
	
	/*--------------------------------------------------------------------------------------------------------------
	 
	        Iterator interface implementation.
	 
	 *-------------------------------------------------------------------------------------------------------------*/
	private	$__iterator_index	=  null ;
	
	
	public function  rewind ( )
	   { $this -> __iterator_index = 0 ; }
	
	public function  valid ( )
	   { return ( $this -> __iterator_index  >=  0  &&  $this -> __iterator_index  <  count ( $this -> PropertyNames ) ) ; }
	
	public function  next ( )
	   { $this -> __iterator_index ++ ; }
	
	public function  key ( )
	   { return ( $this -> PropertyNames [ $this -> __iterator_index ] ) ; }
	
	public function  current ( )
	   {
		$property	=  $this -> PropertyNames [ $this -> __iterator_index ] ;
		
		return  ( $this -> $property ) ;
	    }
    }