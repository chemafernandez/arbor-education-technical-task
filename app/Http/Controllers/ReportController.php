<?php

namespace App\Http\Controllers;

use App\Interfaces\ListableInterface;
use App\Interfaces\CountableInterface;
use App\Interfaces\RateableInterface;
use App\Classes\MessagesCounter;
use App\Classes\MessagesRater;
use App\Classes\MessagesList;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReportController extends Controller
{
    private ListableInterface $list;
    private CountableInterface $counter;
    private RateableInterface $rater;

    public function __construct(
        MessagesList $list,
        MessagesCounter $counter,
        MessagesRater $rater,
    )
    {
        $this->list = $list;
        $this->counter = $counter;
        $this->rater = $rater;
    }

    public function index() {
        //
    }
    
    /**
     * Return to the view, the list of all messages and, messages counts and rates by status
     */
    public function reportAllMessages(): View {
        // All messages
        $messagesList = $this->list->getAllMessages();
        $messagesListCount = $messagesList->count();

        // Number of SENT messages and rate
        $messagesSentCount = $this->counter->countSentMessages();
        $messagesSentRate = $this->rater->calculateRate($messagesSentCount, $messagesListCount);

        // Number of DELIVERED messages and rate
        $messagesDeliveredCount = $this->counter->countDeliveredMessages();
        $messagesDeliveredRate = $this->rater->calculateRate($messagesDeliveredCount, $messagesListCount);

        // Number of FAILED messages and rate
        $messagesFailedCount = $this->counter->countFailedMessages();
        $messagesFailedRate = $this->rater->calculateRate($messagesFailedCount, $messagesListCount);

        // Number of REJECTED messages and rate
        $messagesRejectedCount = $this->counter->countRejectedMessages();
        $messagesRejectedRate = $this->rater->calculateRate($messagesRejectedCount, $messagesListCount);

        return view('report_all', [
            'messagesList'              => $messagesList,
            'messagesSentCount'         => $messagesSentCount,
            'messagesSentRate'          => $messagesSentRate,
            'messagesDeliveredCount'    => $messagesDeliveredCount,
            'messagesDeliveredRate'     => $messagesDeliveredRate,
            'messagesFailedCount'       => $messagesFailedCount,
            'messagesFailedRate'        => $messagesFailedRate,
            'messagesRejectedCount'     => $messagesRejectedCount,
            'messagesRejectedRate'      => $messagesRejectedRate,
        ]);
    }

    /**
     * Return to the view, the list of messages grouped by recipient
     */
    public function reportMessagesByRecipient(): View {
        $this->list = new MessagesList();
        $messagesListGrouped = $this->list->getMessagesGroupedByRecipient();

        return view('report_by_recipient', [
            'recipientsList' => $messagesListGrouped,           
        ]);
    }
}
