use Monolog\Logger;

class Log {
    private $logger;

    public function __construct() {
        $this->logger = new Logger('my_logger');
        $this->logger->pushHandler(new StreamHandler(__DIR__.'/../logs/app.log', Logger::DEBUG));
    }

    public function info($message) {
        $this->logger->info($message);
    }

    public function warning($message) {
        $this->logger->warning($message);
    }

    public function error($message) {
        $this->logger->error($message);
    }

    public function critical($message) {
        $this->logger->critical($message);
    }

    public function alert($message) {
        $this->logger->alert($message);
    }

    public function emergency($message) {
        $this->logger->emergency($message);
    }
}