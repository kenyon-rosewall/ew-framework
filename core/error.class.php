<?php

class error extends Exception
{
	protected int $severity ;
	protected string $message ;
	protected int $code ;
	protected string $file ;
	protected int $line ;
	
	public __construct ([ string $message = "" [, int $code = 0 [, int $severity = 1 [, string $filename = __FILE__ [, int $lineno = __LINE__ [, Exception $previous = NULL ]]]]]] )
	final public int getSeverity ( void )
	final public string Exception::getMessage ( void )
	final public Exception Exception::getPrevious ( void )
	final public mixed Exception::getCode ( void )
	final public string Exception::getFile ( void )
	final public int Exception::getLine ( void )
	final public array Exception::getTrace ( void )
	final public string Exception::getTraceAsString ( void )
	public string Exception::__toString ( void )
	final private void Exception::__clone ( void )
}