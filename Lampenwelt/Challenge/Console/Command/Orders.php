<?php
namespace Lampenwelt\Challenge\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Lampenwelt\Challenge\Model\Order\OrdersList;

class Orders extends Command
{
    const NAME_ARGUMENT = "request_result";

    /**
     * @var OrdersList
     */
    protected $ordersList;

    /**
     * @param OrdersList $ordersList
     * @param string|null $name
     */
    public function __construct(
        OrdersList $ordersList,
        ?string $name = null
    ) {
        parent::__construct($name);
        $this->ordersList = $ordersList;
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(
        InputInterface $input,
        OutputInterface $output
    ) {
        $parameter = $input->getArgument(self::NAME_ARGUMENT);
        $output->writeln("The list of orders with request result " . $parameter);
        $orders = $this->ordersList->getOrdersList($parameter);
        foreach ($orders as $order) {
            $output->writeln($order->getOrderId() . ' - ' . $order->getReturnCode());
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->setName("challenge:orders");
        $this->setDescription("Getting list of orders");
        $this->setDefinition([
            new InputArgument(self::NAME_ARGUMENT, InputArgument::OPTIONAL, "Request status")
        ]);
        parent::configure();
    }
}
