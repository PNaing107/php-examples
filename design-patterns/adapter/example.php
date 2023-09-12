<?php

/* 
Imagine you have a new smartphone with a USB-C port, but you also have some old devices with micro-USB connectors.
You want to use your new phone to charge and transfer data with these older devices. Here's how the Adapter pattern can help.
*/

// 1. Target Interface (define the behaviour we want our code to follow)
interface USB_C {
    public function charge();
    public function transferData();
}

// 2. Adaptee (the class we want to adapt)
class MicroUSB {
    public function plugMicroUSB() {
        echo "Plugging in Micro-USB...\n";
    }

    public function transferData() {
        echo "Transferring data using Micro-USB...\n";
    }

    public function chargeWithMicroUSB() {
        echo "Charging with Micro-USB...\n";
    }
}

// 3. Adapter (it implements the target interface and acts as a wrapper for the adaptee)
class MicroUSBAdapter implements USB_C {
    private $microUSBDevice;

    public function __construct(MicroUSB $microUSBDevice) {
        $this->microUSBDevice = $microUSBDevice;
    }

    public function charge() {
        echo "Adapting and charging using USB-C...\n";
        $this->microUSBDevice->chargeWithMicroUSB();
    }

    public function transferData() {
        echo "Adapting and transferring data using USB-C...\n";
        $this->microUSBDevice->transferData();
    }
}

// 4. Our Code

$oldDevice = new MicroUSB(); // Old device with Micro-USB

$adapter = new MicroUSBAdapter($oldDevice);

// Charging and transferring data as if it were a USB-C using the adapter
$adapter->charge();
$adapter->transferData();

