<?php

namespace App\Application\Controllers;

use App\Application\Accounting\DTO\JournalEntryDTO;
use App\Application\Accounting\UseCases\RegisterJournalEntry;
use App\Infrastructure\Accounting\Repositories\JournalEntryRepository;
use App\Infrastructure\Accounting\Repositories\AccountRepository;

class JournalController
{
    private RegisterJournalEntry $registerJournalEntry;

    public function __construct()
    {
        $journalEntryRepository = new JournalEntryRepository();
        $accountRepository = new AccountRepository();
        $this->registerJournalEntry = new RegisterJournalEntry($journalEntryRepository, $accountRepository);
    }

    public function registerJournalEntry(array $data): void
    {
        // Validate required keys
        if (!isset($data['accountId'], $data['description'], $data['debit'], $data['credit'])) {
            throw new \Exception("Missing required fields: accountId, description, debit, or credit.");
        }

        $journalEntryDTO = new JournalEntryDTO(
            $data['accountId'],
            $data['description'],
            $data['debit'],
            $data['credit']
        );

        $this->registerJournalEntry->execute($journalEntryDTO);

        echo json_encode(['message' => 'Journal entry registered successfully']);
    }
}
