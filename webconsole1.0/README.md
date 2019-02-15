# INTRODUCTION #

The **ProcessList** class provides a platform-independent way to retrieve the list of processes running on your systems. It works both on the Windows and Unix platforms.


# OVERVIEW #

To retrieve the list of processes currently running on your system, simply use the following :

	require ( 'ProcessList.phpclass' ) ;

	$ps 	=  new ProcessList ( ) ;

The *$ps* variable can now be accessed as an array to retrieve process information, which is simply an object of class **Process** :

	foreach  ( $ps  as  $process )
		echo ( "PID : {$process -> ProcessId}, COMMAND : {$this -> Command}" ) ;

Whether you are running on Windows or Unix, the properties exposed by the *Process* objects remain the same (see the **Reference** section).


# DEPENDENCIES #

For Windows platforms, you will need the following package :

	http://www.phpclasses.org/package/10001-PHP-Provides-access-to-Windows-WMI.html

A copy of the source code is provided here for your convenience, but it may not be the latest release...


# Reference #

## ProcessList class ##

The **ProcessList** class is a container class that allows you to retrieve information about individual processes. It implements the *ArrayAccess* and *Iterator* interfaces, so that you can loop through each process currently running on your system.

Each element of a *ProcessList* array is an object of class **Process**.  

### Constructor ###

	public function  __construct  ( $load = true ) ;

Creates a process list object. If the *$load* parameter is true, the process list will be retrieved ; otherwise, you will need to call the *Refresh()* method later before looping through the list of available processes.

### GetProcess ###

	public function  GetProcess ( $id ) ;

Searches for a process having the specified *$id*.

Returns an object of class **Process** if found, or *false* otherwise.

### GetProcessByName ###

	public function  GetProcessByName ( $name ) ;

Searches for a process having the specified name. The name is given by the *Command* property of the **Process** object.


### GetChildren ###

	public function  GetChildren ( $id ) ;

Returns the children of the specified process, or an empty array if *$id* does not specify a valid process id.


### Refresh ###

	public function  Refresh ( ) ;

Refreshes the current process list. This function can be called as many times as desired on the same **ProcessList** object.


## Process class ##

The **Process** class does not contain methods, but simply expose properties that contain information about a process.

### Argv property ###

Contains the command-line arguments of the process. As for C (and PHP) programs, Argv[0] represents the command path.

### Command ###

Command name, without its leading path.

### CommandLine ###

Full command line, including arguments.

### CpuTime ###

CPU time consumed by the process, in the form "hh:mm:ss".

### ParentProcessId ###

Dd of the parent process for this process.

### ProcessId ###

Process id of the current process.

### StartTime ###

Process start time, in the form "yyyy-mm-dd hh:mm:ss".

### Title ###

Process title. On Windows systems, it will be the title of the process. Since there is no notion of process title on Unix systems, it will be set to the value of the *Command* property.

### Tty ###

Attached tty. This information is useful mainly for Unix systems.

### User property ###

User name running the process. On Unix systems, this can be either a user name or a user id.
