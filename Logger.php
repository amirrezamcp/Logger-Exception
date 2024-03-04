<?php
class Logger {
    private string $logFile;

    public function __construct() {
        $this->logFile = __DIR__ . "/logger.txt";

        set_error_handler([$this, 'Error']);
        set_exception_handler([$this, 'Exception']);
    }

    public function Error(int $Errorline, string $messageError, string $fileError, int $codeError){
        $dateTime = new DateTime();
        $message = $this->formatMessage('Error', $Errorline, $messageError, $fileError, $codeError, $dateTime);
        $this->writeLog($message);
    }

    public function Exception(throwable $exception) {
        $dateTime = new DateTime();
        $message = $this->formatMessage('Exception', $exception->getMessage(),$exception->getCode(), $exception->getFile(), $exception->getLine(), $dateTime);
        $this->writeLog($message);
    }

    public function formatMessage(string $type, $code, string $massage, string $file, int $line, DateTime $dateTime) {
        $log = "----------------------------------------------------------------\n" .
                "Type:" . $type . "\n" .
                "code:" . $code . "\n" .
                "massage:" . $massage . "\n" .
                "file:" . $file . "\n" .
                "line:" . $line . "\n" .
                "date: " . $dateTime->format('Y-m-d H:i:s') . "\n";
                var_dump($log);
        return $log;
    }

    public function writeLog(string $massage) {
        file_put_contents($this->logFile, $massage, FILE_APPEND);
    }
}

$logger = new Logger();