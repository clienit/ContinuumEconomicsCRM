<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use App\Models\User;
use App\Models\Client;

class ClientTest extends TestCase
{
    use DatabaseMigrations;
    
    protected $loggedUser;

    public function setUp(): void
    {
        parent::setUp();
        $this->loggedUser = User::factory()->make();
    }

    // CREATE
    public function testUserCannotCreateClientIfNotLoggedIn()
    {
        $client = Client::factory()->make()->toArray();
        $response = $this->post('clients', $client);
        $response->assertRedirect('login');
        
        $this->assertDatabaseMissing('clients', $client);
    }

    public function testUserCanCreateClientIfLoggedIn()
    {
        $client = Client::factory()->make()->toArray();
        $response = $this->actingAs($this->loggedUser)
            ->post('clients', $client);
        $response->assertStatus(302);
    }

    public function testUserCanNotCreateClientIfLoggedInWithProperImage()
    {
        Storage::fake('public');

        $client = Client::factory()->make()->toArray();
        $avatar = UploadedFile::fake()->image('image.png', 80, 80);
        $response = $this->actingAs($this->loggedUser)
            ->json('POST', '/clients', array_merge(
                $client,
                ['avatar' => $avatar]
            ));
        $response->assertStatus(422);
    }

    // LIST
    public function testUserCannotAccessClientsIfNotLoggedIn()
    {
        $clients = Client::factory()->create();
        $response = $this->get('clients');
        $response->assertRedirect('login');
    }

    public function testUserCanAccessClientsIfLoggedIn()
    {
        $client = Client::factory()->create();
        $response = $this->actingAs($this->loggedUser)
            ->get('clients');
        $response->assertSuccessful();
    }    

    // UPDATE
    public function testUserCannotUpdateClientIfNotLoggedIn()
    {
        $client = Client::factory()->create();
        $client->first_name = $client->first_name . '_updated';
        
        $response = $this->put('clients/' . $client->id, 
            [
                'first_name' => $client->first_name,
                'last_name' => $client->last_name,
                'email' => $client->email,
                'avatar' => $client->avatar
            ]);
        $response->assertRedirect('login');
        $this->assertDatabaseMissing('clients', ['first_name' => $client->first_name]);
    }

    public function testUserCanUpdateClientIfLoggedIn()
    {
        $client = Client::factory()->create();
        $updaed_client_first_name = $client->first_name . '_updated';
        
        $response = $this->actingAs($this->loggedUser)
            ->put('clients/' . $client->id, 
            [
                'first_name' => $updaed_client_first_name,
                'last_name' => $client->last_name,
                'email' => $client->email,
                'avatar' => $client->avatar
            ]);
        $response->assertStatus(302);
    }

    // DELETE
    public function testUserCannotDeleteClientIfNotLoggedIn()
    {
        $client = Client::factory()->create();
        $response = $this->delete('clients/' . $client->id);
        $response->assertRedirect('login');
        $this->assertDatabaseHas('clients', ['id' => $client->id]);
    }

    public function testUserCanDeleteClientIfLoggedIn()
    {
        $client = Client::factory()->create();
        $response = $this->actingAs($this->loggedUser)
            ->delete('clients/' . $client->id);
        $response->assertStatus(200);
        $this->assertDatabaseMissing('clients', ['id' => $client->id]);
    }
}