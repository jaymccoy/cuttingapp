<?php


class FileLoggerException extends Exception
{
}


class Logger
{

    protected $fileHandle = NULL;

    protected $timeFormat = 'd.m.Y - H:i:s';

    /**
     * The file permissions.
     */
    const FILE_CHMOD = 756;

    const NOTICE = '[NOTICE]';
    const WARNING = '[WARNING]';
    const ERROR = '[ERROR]';
    const FATAL = '[FATAL]';

    /**
     * Opens the file handle.
     *
     * @param string $logfile The path to the loggable file.
     */
    public function __construct($logfile)
    {
        if ($this->fileHandle == NULL) {
            $this->openLogFile($logfile);
        }
    }

    /**
     * Closes the file handle.
     */
    public function __destruct()
    {
        $this->closeLogFile();
    }

    /**
     * Logs the message into the log file.
     *
     * @param string $message The log message.
     * @param int $messageType Optional: urgency of the message.
     */
    public function log($message, $messageType = Logger::WARNING)
    {
        if ($this->fileHandle == NULL) {
            throw new FileLoggerException('Logfile is not opened.');
        }

        if (!is_string($message)) {
            throw new FileLoggerException('$message is not a string');
        }

        if ($messageType != Logger::NOTICE &&
            $messageType != Logger::WARNING &&
            $messageType != Logger::ERROR &&
            $messageType != Logger::FATAL
        ) {
            throw new FileLoggerException('Wrong $messagetype given.');
        }

        $this->writeToLogFile("[" . $this->getTime() . "]" . $messageType . " - " . $message);
    }

    /**
     * Writes content to the log file.
     *
     * @param string $message
     */
    private function writeToLogFile($message)
    {
        flock($this->fileHandle, LOCK_EX);
        fwrite($this->fileHandle, $message . PHP_EOL);
        flock($this->fileHandle, LOCK_UN);
    }

    /**
     * Returns the current timestamp.
     *
     * @return string with the current date
     */
    private function getTime()
    {
        return date($this->timeFormat);
    }

    /**
     * Closes the current log file.
     */
    protected function closeLogFile()
    {
        if ($this->fileHandle != NULL) {
            fclose($this->fileHandle);
            $this->fileHandle = NULL;
        }
    }

    /**
     * Opens a file handle.
     *
     * @param string $logFile Path to log file.
     */
    public function openLogFile($logFile)
    {
        $this->closeLogFile();

        if (!is_dir(dirname($logFile))) {
            if (!mkdir(dirname($logFile), Logger::FILE_CHMOD, true)) {
                throw new FileLoggerException('Could not find or create directory for log file.');
            }
        }

        if (!$this->fileHandle = fopen($logFile, 'a+')) {
            throw new FileLoggerException('Could not open file handle.');
        }
    }


}

