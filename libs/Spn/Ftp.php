<?php
/**
 * 
 * @author: An Souphorn <ansouphorn@gmail.com>
 * @copyright: Copyright 2010, Maxaware
 * @package: 
 * Blog: souphorn.blogspot.com
 */

 class Spn_Ftp
 {
 	private $con;
 	private $defaultPath; 	
 	function __construct($host,$user,$pass,$port = null)
 	{
 		if ($port == null)
 			$this->con = ftp_connect($host);
 		else 
 			$this->con = ftp_connect($host,$port);
 		$this->defaultPath = (ftp_login($this->con, $user, $pass)) ? ftp_pwd($this->con) : false;
		
 	}
	private function setDefaultPath($path)
	{
		$this->defaultPath = $path;
	}
 	public function copyDirFtp($sourceBaseDir, $defaultFtpDir, $source, $dest)
	{
		$this->setDefaultPath($defaultFtpDir);
		$dir = dir($sourceBaseDir.$source);
		while ($file = $dir->read())
 		{
			if ($file != '.' && $file != '..' && $file !='.svn')
 			{
				if (is_dir($sourceBaseDir.$source.'/'.$file))
				{
					
					$this->copyDir($sourceBaseDir, $source.'/'.$file, $dest.$file.'/');						
				}
				if (is_file($sourceBaseDir.$source.'/'.$file))
				{			
					//echo $defaultFtpDir.'/'.$dest.$file;
					//continue; 
					$mod = substr(sprintf('%o', fileperms($sourceBaseDir.$source.'/'.$file)), -4);					
					$mod = octdec( str_pad($mod,4,'0',STR_PAD_LEFT) );
					//ftp_put($this->con, $defaultFtpDir.$dest.$file, $sourceBaseDir.$source.'/'.$file, FTP_ASCII);
					
					ftp_put($this->con, $defaultFtpDir.'/'.$dest.$file, $sourceBaseDir.$source.'/'.$file, FTP_BINARY);
					ftp_chmod($this->con,$mod, $defaultFtpDir.'/'.$dest.$file);
				}
			}
		}
		$dir->close();
	}
 	private function copyDir($sourceBaseDir, $source, $dest)
 	{
 		//Check whether the connection exist or not
 		if ($this->defaultPath == false)
 		{
 			die("1020"); 			
 		}
 		
		$dir = dir($sourceBaseDir.$source); 			
		$mod = substr(sprintf('%o',fileperms($sourceBaseDir.$source)),-4);
		
		$mod = octdec(str_pad($mod,4,'0',STR_PAD_LEFT));
		//echo $this->defaultPath.'/'.$dest."\n";
		ftp_mkdir($this->con, $this->defaultPath.'/'.$dest);
		ftp_chmod($this->con, $mod,$this->defaultPath.'/'.$dest); 
		while (false !== ($file = $dir->read()))
		{
			if ($file != '.' && $file != '..' && $file !='.svn')
			{
				if (is_dir($sourceBaseDir.$source.'/'.$file))
				{
					$this->copyDir($sourceBaseDir, $source.'/'.$file, $dest.$file.'/');						
				}
				if (is_file($sourceBaseDir.$source.'/'.$file))
				{
					//echo $this->defaultPath.'/'.$dest.$file.'-----'.$sourceBaseDir.$source.'/'.$file."\n";
					//continue;
					$mod = substr(sprintf('%o', fileperms($sourceBaseDir.$source.'/'.$file)), -4);					
					$mod = octdec( str_pad($mod,4,'0',STR_PAD_LEFT) ); 
					if (ftp_put($this->con, $this->defaultPath.'/'.$dest.$file, $sourceBaseDir.$source.'/'.$file, FTP_BINARY))
						ftp_chmod($this->con,$mod, $this->defaultPath.'/'.$dest.$file);
				}
			}
		}
		
		$dir->close();
 	}
 	
 	/**
 	 * 
 	 * Get the ftp connection session
 	 * 
 	 */
 	public function getConnection()
 	{
 		return $this->con;
 	}
 	
 	public function closeConnection()
 	{
 		ftp_close($this->con);
 	}
 }
 ?>