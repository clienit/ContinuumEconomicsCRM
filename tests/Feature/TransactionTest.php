<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use App\Models\User;
use App\Models\Transaction;

class TransactionTest extends TestCase
{
    use DatabaseMigrations;
    
    protected $loggedUser;

    public function setUp(): void
    {
        parent::setUp();
        $this->loggedUser = User::factory()->make();
    }

    // CREATE
    public function testUserCannotCreateTransactionIfNotLoggedIn()
    {
        $transaction = Transaction::factory()->make()->toArray();
        $response = $this->post('transactions', $transaction);
        $response->assertRedirect('login');
        $this->assertDatabaseMissing('transactions', $transaction);
    }

    public function testUserCanCreateTransactionIfLoggedIn()
    {
        $transaction = Transaction::factory()->make()->toArray();
        $response = $this->actingAs($this->loggedUser)
            ->post('transactions', $transaction);
        $response->assertSuccessful();
        $this->assertDatabaseHas('transactions', $transaction);
    }

    // LIST
    public function testUserCannotAccessTransactionsIfNotLoggedIn()
    {
        $transaction = Transaction::factory()->create();
        $response = $this->get('transactions');
        $response->assertRedirect('login');
    }

    public function testUserCanAccessTransactionsIfLoggedIn()
    {
        $transaction = Transaction::factory()->create();
        $response = $this->actingAs($this->loggedUser)
            ->get('transactions');
        $response->assertSuccessful();
    }    
    
    // VIEW
    public function testUserCannotSeeTransactionsIfNotLoggedIn()
    {
        $transaction = Transaction::factory()->create();

        $response = $this->get('transactions/' . $transaction->id);
        $response->assertRedirect('login');
    }

    // UPDATE
    public function testUserCannotUpdateTransactionIfNotLoggedIn()
    {
        $transaction_master = $transaction = Transaction::factory()->create();
        $transaction->amount = $transaction->amount  + 1000;
        
        $response = $this->put('transactions/' . $transaction->id, 
            [
                'client_id' => $transaction->client_id,
                'transaction_date' => $transaction->transaction_date,
                'amount' => $transaction->amount
            ]);
        $response->assertRedirect('login');
        $this->assertDatabaseMissing('transactions', ['amount' => $transaction->amount]);
    }

    public function testUserCanUpdateTransactionIfLoggedIn()
    {
        $transaction = Transaction::factory()->create();
        $transaction->amount = $transaction->amount  + 1000;
        
        $response = $this->actingAs($this->loggedUser)
            ->put('transactions/' . $transaction->id, 
            [
                'client_id' => $transaction->client_id,
                'transaction_date' => $transaction->transaction_date,
                'amount' => $transaction->amount
            ]);
        $response->assertSuccessful();
        $this->assertDatabaseHas('transactions', ['amount' => $transaction->amount]);
    }

    // DELETE
    public function testUserCannotDeleteTransactionIfNotLoggedIn()
    {
        $transaction = Transaction::factory()->create();
        $response = $this->delete('transactions/' . $transaction->id);
        $response->assertRedirect('login');
        $this->assertDatabaseHas('transactions', ['id' => $transaction->id]);
    }

    public function testUserCanDeletetransactionIfLoggedIn()
    {
        $transaction = Transaction::factory()->create();
        $response = $this->actingAs($this->loggedUser)
            ->delete('transactions/' . $transaction->id);
        $response->assertSuccessful();
        $this->assertDatabaseMissing('transactions', ['id' => $transaction->id]);
    }
}