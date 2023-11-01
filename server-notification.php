<?php 
require dirname(__DIR__) . '/ratcher/vendor/autoload.php';

use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;

class Notification implements MessageComponentInterface  {
    protected $clients;

    public function __construct() {
        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn) {
        $this->clients->attach($conn);
        echo "New connection! ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        $data = json_decode($msg);
        foreach ( $this->clients as $client ) {
            if ( $from->resourceId == $client->resourceId ) {
                continue;
            }
            if(isset($data->LoaiTK, $data->NguoiGui, $data->NguoiNhan, $data->NoiDung)) {
                $client->send(json_encode(
                    array(
                        'LoaiTK' => $data->LoaiTK,
                        'NguoiGui' => $data->NguoiGui,
                        'NguoiNhan' => $data->NguoiNhan,
                        'NoiDung' => $data->NoiDung
                    ), JSON_UNESCAPED_UNICODE
                ));
            }
        }
    }

    public function onClose(ConnectionInterface $conn) {
        $this->clients->detach($conn);
        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "An error has occurred: {$e->getMessage()}\n";
        $conn->close();
    }
}

$server = IoServer::factory(
    new HttpServer(
        new WsServer(
            new Notification()
        )
    ),
    8080
);
echo "********** Server is running...**********\n";
$server->run();
