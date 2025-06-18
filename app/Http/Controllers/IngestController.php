<?php

namespace App\Http\Controllers;

use App\Interfaces\FindableInterface;
use App\Interfaces\FindableOrCreateableInterface;
use App\Classes\RecipientFindableOrCreateable;
use App\Classes\ProviderFindableOrCreateable;
use App\Classes\SenderFindableOrCreateable;
use App\Classes\StudentFindableOrCreateable;
use App\Classes\MessageFindableOrCreateable;
use App\Classes\StatusFindable;
use Exception;
use Illuminate\Http\Request;

class IngestController extends Controller
{
    private const SMS_DATA_FILEPATH = __DIR__ . "/../../../storage/school_messages/";
    private const MESSAGE_SUCCESS = "File ingested correctly";
    private const MESSAGE_ERROR = "Ingestion Error";

    private FindableOrCreateableInterface $recipientFindable;
    private FindableOrCreateableInterface $senderFindable;
    private FindableOrCreateableInterface $studentFindable;
    private FindableOrCreateableInterface $providerFindable;
    private FindableOrCreateableInterface $messageFindable;
    private FindableInterface $statusFindable;

    /**
     * Populate the database with data from a json file
     */
    public function index() {
        try {
            // Read sms data file (json format) and convert to array
            $smsDataJson = file_get_contents(self::SMS_DATA_FILEPATH . $_ENV['SMS_DATA_FILENAME'], false);
            $smsList = json_decode($smsDataJson);

            foreach($smsList as $sms) {
                // Insert recipient if it doesn't exist
                $this->recipientFindable = new RecipientFindableOrCreateable();
                $sms->recipient_id = $this->recipientFindable->findOrCreate($sms);

                // Insert sender if it doesn't exist
                $this->senderFindable = new SenderFindableOrCreateable();
                $sms->sender_id = $this->senderFindable->findOrCreate($sms);

                // Insert student if it doesn't exist
                $this->studentFindable = new StudentFindableOrCreateable();
                $sms->student_id = $this->studentFindable->findOrCreate($sms);

                // Insert provider if it doesn't exist
                $this->providerFindable = new ProviderFindableOrCreateable();
                $sms->provider_id = $this->providerFindable->findOrCreate($sms);

                // Find status
                $this->statusFindable = new StatusFindable();
                $sms->status_id = $this->statusFindable->find($sms);

                // Insert message if it doesn't exist
                $this->messageFindable = new MessageFindableOrCreateable();
                $sms->message_id = $this->messageFindable->findOrCreate($sms);
            }

            return response()->json([
                'success' => true,
                'message' => self::MESSAGE_SUCCESS],
            200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => self::MESSAGE_ERROR,
                'error_message' => $e->getMessage()],
            400);
        }
    }
}
