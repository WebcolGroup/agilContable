<?php

namespace App\Application\Accounting\UseCases;

use App\Application\Accounting\DTO\JournalEntryDTO;
use App\Domain\Accounting\Entities\JournalEntry;
use App\Domain\Accounting\Interfaces\JournalEntryRepositoryInterface;
use App\Domain\Accounting\Interfaces\AccountRepositoryInterface;

class RegisterJournalEntry
{
    private JournalEntryRepositoryInterface $journalEntryRepository;
    private AccountRepositoryInterface $accountRepository;

    public function __construct(JournalEntryRepositoryInterface $journalEntryRepository, AccountRepositoryInterface $accountRepository)
    {
        $this->journalEntryRepository = $journalEntryRepository;
        $this->accountRepository = $accountRepository;
    }

    private function validateJournalEntry(array $entries): void
    {
        $debitSum = 0;
        $creditSum = 0;

        foreach ($entries as $entry) {
            if (!isset($entry['accountId'], $entry['debit'], $entry['credit'])) {
                throw new \Exception("Each entry must have an accountId, debit, and credit.");
            }

            if ($entry['debit'] > 0 && $entry['credit'] > 0) {
                throw new \Exception("An entry cannot have both debit and credit values.");
            }

            $debitSum += $entry['debit'];
            $creditSum += $entry['credit'];
        }

        if (count($entries) < 2) {
            throw new \Exception("A journal entry must have at least two entries.");
        }

        if ($debitSum !== $creditSum) {
            throw new \Exception("The journal entry is not balanced. Debit and credit sums must be equal.");
        }
    }

    public function execute(JournalEntryDTO $journalEntryDTO): void
    {
        $account = $this->accountRepository->findById($journalEntryDTO->accountId);

        if (!$account) {
            throw new \Exception("Account with ID {$journalEntryDTO->accountId} does not exist.");
        }

        // Example entries for validation (replace with actual data)
        $entries = [
            ['accountId' => $journalEntryDTO->accountId, 'debit' => $journalEntryDTO->debit, 'credit' => $journalEntryDTO->credit],
            // Add more entries as needed
        ];

        $this->validateJournalEntry($entries);

        $journalEntry = new JournalEntry(
            uniqid(),
            $journalEntryDTO->accountId,
            $journalEntryDTO->description,
            $journalEntryDTO->debit,
            $journalEntryDTO->credit,
            new \DateTime()
        );

        $this->journalEntryRepository->save($journalEntry);
    }
}
