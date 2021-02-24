<?php

namespace Tests\Feature;

use App\Models\Expense;
use App\Models\User;
use Database\Factories\ExpenseFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class ExpenseApiTest extends TestCase
{
    public function test_any_user_can_create_an_expense()
    {
        $user = User::factory()->create();

        $token = $user->createToken('Personal Access Token')->accessToken;

        $headers = ['Authorization' => "Bearer $token", 'Accept' => 'application/json'];

        $file = UploadedFile::fake()->image('avatar.jpg');

        $payload = [
            'name' => 'Transmission Fees',
            'amount' => 120,
            'entry_date' => '2021-02-24',
            'user_id' => $user->id,
            'attachment' => $file
        ];

        $response = $this->postJson('/api/expense', $payload, $headers)
            ->assertStatus(200)
            ->assertJson([
                'result' => true,
                'message' => 'done'
            ]);

        $response->assertSuccessful();

        $this->assertDatabaseHas('expenses', [
            'name' => 'Transmission Fees',
            'amount' => 120,
            'entry_date' => '2021-02-24',
            'user_id' => $user->id,
        ]);
    }

    public function test_user_can_view_list_of_expenses()
    {
        $user = User::factory()->create();
        $token = $user->createToken('Personal Access Token')->accessToken;
        $headers = ['Authorization' => "Bearer $token", 'Accept' => 'application/json'];

        // Get all expenses (Paginated)
        $response = $this->get('/api/expense', $headers);

        $response->assertSuccessful();

        $response->assertJsonStructure([
            "result",
            "data" => [
                "current_page",
                "data" => [
                    '*' => [
                        "id",
                        "name",
                        "amount",
                        "attachment",
                        "entry_date",
                        "status",
                        "user_id",
                        "deleted_at",
                        "created_at",
                        "updated_at",
                        "user" => [
                            "id",
                            "name",
                            "email",
                            "isManager",
                            "created_at",
                            "updated_at",
                            "role_id"
                        ]
                    ]
                ],
                "first_page_url",
                "from",
                "last_page",
                "last_page_url",
                "links" => [
                   '*' => [
                        "url",
                        "label",
                        "active",
                    ],
                ],
                "next_page_url",
                "path",
                "per_page",
                "prev_page_url",
                "to",
                "total",
            ]
        ]);
    }

    public function test_employee_can_see_just_his_expense()
    {
        $user = User::factory()->make();
        $token = $user->createToken('Personal Access Token')->accessToken;
        $headers = ['Authorization' => "Bearer $token", 'Accept' => 'application/json'];

        $expense = Expense::factory()->create();

        $this->actingAs($user)
            ->get('/api/expense/'.$expense->id, $headers)
            ->assertStatus(401)
            ->assertUnauthorized();
    }

    public function test_manager_approve_an_expense()
    {
        $user = User::factory()->make();
        $user->role_id = 1;
        $user->save();

        $token = $user->createToken('Personal Access Token')->accessToken;
        $headers = ['Authorization' => "Bearer $token", 'Accept' => 'application/json'];

        $expense = Expense::factory()->create();

        $this->actingAs($user)
            ->get(route('api.expense.approve', $expense->id), $headers)
            ->assertJson([
                'result' => true,
            ])
            ->assertStatus(200);
    }

    public function test_only_manager_can_approve_expense()
    {
        $user = User::factory()->make();
        $token = $user->createToken('Personal Access Token')->accessToken;
        $headers = ['Authorization' => "Bearer $token", 'Accept' => 'application/json'];

        $expense = Expense::factory()->create();

        $this->actingAs($user)
            ->get(route('api.expense.approve', $expense->id), $headers)
            ->assertUnauthorized();
    }

    public function test_manager_reject_an_expense()
    {
        $user = User::factory()->make();
        $user->role_id = 1;
        $user->save();

        $token = $user->createToken('Personal Access Token')->accessToken;
        $headers = ['Authorization' => "Bearer $token", 'Accept' => 'application/json'];

        $expense = Expense::factory()->create();

        $this->actingAs($user)
            ->get(route('api.expense.reject', $expense->id), $headers)
            ->assertJson([
                'result' => true,
            ])
            ->assertStatus(200);
    }

    public function test_employee_can_cancel_just_his_expense()
    {
        $user = User::factory()->create();
        $token = $user->createToken('Personal Access Token')->accessToken;
        $headers = ['Authorization' => "Bearer $token", 'Accept' => 'application/json'];

        $expense = Expense::factory()->make();
        $expense->user_id = $user->id;
        $expense->save();

        $this->actingAs($user)
            ->get(route('api.expense.cancel', $expense->id), $headers)
            ->assertJson([
                'result' => true,
            ])
            ->assertStatus(200);
    }

}
