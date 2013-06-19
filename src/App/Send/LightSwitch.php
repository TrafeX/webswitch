<?php
namespace App\Send;

use Symfony\Component\Process\Process;

class LightSwitch
{
    const SEND_COMMAND = '/home/pi/433raspberry/433-send';
    const SYSTEMCODE = 13;

    public function turnOn($id)
    {
       return $this->execute($id, 'on');
    }

    public function turnOff($id)
    {
       return $this->execute($id, 'off');
    }

    public function execute($id, $state)
    {
        $cmd = sprintf(
            '%s -p elro -u %u -i %u --%s',
            self::SEND_COMMAND,
            self::SYSTEMCODE,
            $id,
            $state
        );
        $process = new Process($cmd);
        $process->run();

        if (!$process->isSuccessful()) {
            throw new \RuntimeException($process->getErrorOutput());
        }
        return $process->getOutput();
    }
}
