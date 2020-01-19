<?php

namespace Tests\Feature\Catalogue;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CatalogueTest extends TestCase
{
    public function testGetAllCataloguesWithoutAuthorization()
    {
        $header = [];
        $payload = [];
        $this->json('get', '/api/catalogues', $payload, $header)
            ->assertStatus(401);
    }

    public function testGetCatalogueWithoutAuthorization()
    {
        $header = [];
        $payload = [];
        $this->json('get', '/api/catalogues/$DEFAULT', $payload, $header)
            ->assertStatus(401);
    }

    public function testCreateCatalogueWithoutAuthorization()
    {
        $header = [];
        $payload = [];
        $this->json('post', '/api/catalogues', $payload, $header)
            ->assertStatus(401);
    }

    public function testUpdateCatalogueWithoutAuthorization()
    {
        $header = [];
        $payload = [];
        $this->json('put', '/api/catalogues/$DEFAULT', $payload, $header)
            ->assertStatus(401);
    }

    public function testDeleteCatalogueWithoutAuthorization()
    {
        $header = [];
        $payload = [];
        $this->json('delete', '/api/catalogues/$DEFAULT', $payload, $header)
            ->assertStatus(401);
    }

    public function testGetAllCataloguesWithoutAuthAccess()
    {
        $header = [
            'Authorization' => "Bearer $this->officer_access_token",
        ];
        $payload = [];
        $this->json('get', '/api/catalogues', $payload, $header)
            ->assertStatus(403)
            ->assertJson([
                'success' => 'false',
                'message' => 'You do not have access to retrieve Catalogues.'
            ]);
    }

    public function testGetCatalogueWithoutAuthAccess()
    {
        $header = [
            'Authorization' => "Bearer $this->officer_access_token",
        ];
        $payload = [];
        $this->json('get', '/api/catalogues/$DEFAULT', $payload, $header)
            ->assertStatus(403)
            ->assertJson([
                'success' => 'false',
                'message' => 'You do not have access to retrieve a Catalogue.'
            ]);
    }

    public function testCreateCatalogueWithoutAuthAccess()
    {
        $header = [
            'Authorization' => "Bearer $this->officer_access_token",
        ];
        $payload = [
            'catalogue_code' => 'CLG',
            'description' => 'My Catalogue',
            'details' => 'My Catalogue',
            'status' => 'A',
        ];
        $this->json('post', '/api/catalogues', $payload, $header)
            ->assertStatus(403)
            ->assertJson([
                'success' => 'false',
                'message' => 'You do not have access to create a Catalogue.'
            ]);
    }

    public function testUpdateCatalogueWithoutAuthAccess()
    {
        $header = [
            'Authorization' => "Bearer $this->officer_access_token",
        ];
        $payload = [
            'catalogue_code' => '$DEFAULT',
            'description' => 'My Catalogue',
            'details' => 'My Catalogue',
            'status' => 'A',
        ];
        $this->json('put', '/api/catalogues/$DEFAULT', $payload, $header)
            ->assertStatus(403)
            ->assertJson([
                'success' => 'false',
                'message' => 'You do not have access to update a Catalogue.'
            ]);
    }

    public function testDeleteCatalogueWithoutAuthAccess()
    {
        $header = [
            'Authorization' => "Bearer $this->officer_access_token",
        ];
        $payload = [];
        $this->json('delete', '/api/catalogues/$DEFAULT', $payload, $header)
            ->assertStatus(403)
            ->assertJson([
                'success' => 'false',
                'message' => 'You do not have access to delete a Catalogue.'
            ]);
    }

    public function testGetAllCatalogues()
    {
        $header = [
            'Authorization' => "Bearer $this->admin_access_token",
        ];
        $payload = [];
        $this->json('get', '/api/catalogues', $payload, $header)
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    [
                        'catalogue_code',
                        'description',
                        'details',
                        'status',
                        'created_at',
                        'updated_at',
                    ]
                ]
            ]);
    }

    public function testGetCatalogue()
    {
        $header = [
            'Authorization' => "Bearer $this->admin_access_token",
        ];
        $payload = [];
        $this->json('get', '/api/catalogues/$DEFAULT', $payload, $header)
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'catalogue_code',
                    'description',
                    'details',
                    'status',
                    'created_at',
                    'updated_at',
                ],
            ]);
    }

    public function testGetInvalidCatalogue()
    {
        $header = [
            'Authorization' => "Bearer $this->admin_access_token",
        ];
        $payload = [];
        $this->json('get', '/api/catalogues/DEFAULT', $payload, $header)
            ->assertStatus(404)
            ->assertJson([
                'success' => 'false',
                'message' => 'Catalogue does not exist.'
            ]);
    }

    public function testCreateCatalogueWithoutRequiredFields()
    {
        $header = [
            'Authorization' => "Bearer $this->admin_access_token",
        ];
        $payload = [];
        $this->json('post', '/api/catalogues', $payload, $header)
            ->assertStatus(400)
            ->assertJson([
                'catalogue_code' => [
                    'The catalogue code field is required.'
                ],
                'description' => [
                    'The description field is required.'
                ],
                'status' => [
                    'The status field is required.'
                ],
            ]);
    }

    public function testCreateCatalogueWithoutUniqueId()
    {
        $header = [
            'Authorization' => "Bearer $this->admin_access_token",
        ];
        $payload = [
            'catalogue_code' => '$DEFAULT',
            'description' => 'My Catalogue',
            'details' => 'My Catalogue',
            'status' => 'A',
        ];
        $this->json('post', '/api/catalogues', $payload, $header)
            ->assertStatus(400)
            ->assertJson([
                'catalogue_code' => [
                    'The catalogue code has already been taken.'
                ],
            ]);
    }

    public function testCreateCatalogueWithInvalidStatus()
    {
        $header = [
            'Authorization' => "Bearer $this->admin_access_token",
        ];
        $payload = [
            'catalogue_code' => 'CLG',
            'description' => 'My Catalogue',
            'details' => 'My Catalogue',
            'status' => 'X',
        ];
        $this->json('post', '/api/catalogues', $payload, $header)
            ->assertStatus(400)
            ->assertJson([
                'status' => [
                    'The selected status is invalid.'
                ],
            ]);
    }

    public function testCreateCatalogue()
    {
        $header = [
            'Authorization' => "Bearer $this->admin_access_token",
        ];
        $payload = [
            'catalogue_code' => 'CLG',
            'description' => 'My Catalogue',
            'details' => 'My Catalogue',
            'status' => 'A',
        ];
        $this->json('post', '/api/catalogues', $payload, $header)
            ->assertStatus(201)
            ->assertJsonStructure([
                'data' => [
                    'catalogue_code',
                    'description',
                    'details',
                    'status',
                    'created_at',
                    'updated_at',
                ],
            ]);
    }

    public function testUpdateCatalogueWithoutRequiredFields()
    {
        $header = [
            'Authorization' => "Bearer $this->admin_access_token",
        ];
        $payload = [];
        $this->json('put', '/api/catalogues/$DEFAULT', $payload, $header)
            ->assertStatus(400)
            ->assertJson([
                'catalogue_code' => [
                    'The catalogue code field is required.'
                ],
                'description' => [
                    'The description field is required.'
                ],
                'status' => [
                    'The status field is required.'
                ],
            ]);;
    }

    public function testUpdateCatalogueWithInvalidStatus()
    {
        $header = [
            'Authorization' => "Bearer $this->admin_access_token",
        ];
        $payload = [
            'catalogue_code' => '$DEFAULT',
            'description' => 'My Catalogue',
            'details' => 'My Catalogue',
            'status' => 'X',
        ];
        $this->json('put', '/api/catalogues/$DEFAULT', $payload, $header)
            ->assertStatus(400)
            ->assertJson([
                'status' => [
                    'The selected status is invalid.'
                ],
            ]);
    }

    public function testUpdateCatalogueWithInvalidId()
    {
        $header = [
            'Authorization' => "Bearer $this->admin_access_token",
        ];
        $payload = [
            'catalogue_code' => 'DEFAULT',
            'description' => 'My Catalogue',
            'details' => 'My Catalogue',
            'status' => 'A',
        ];
        $this->json('put', '/api/catalogues/DEFAULT', $payload, $header)
            ->assertStatus(404)
            ->assertJson([
                'success' => 'false',
                'message' => 'Catalogue does not exist.'
            ]);
    }

    public function testUpdateCatalogue()
    {
        $header = [
            'Authorization' => "Bearer $this->admin_access_token",
        ];
        $payload = [
            'catalogue_code' => '$DEFAULT',
            'description' => 'My Catalogue',
            'details' => 'My Catalogue',
            'status' => 'A',
        ];
        $this->json('put', '/api/catalogues/$DEFAULT', $payload, $header)
            ->assertStatus(201)
            ->assertJsonStructure([
                'data' => [
                    'catalogue_code',
                    'description',
                    'details',
                    'status',
                    'created_at',
                    'updated_at',
                ],
            ]);
    }

    public function testDeleteCatalogueWithInvalidId()
    {
        $header = [
            'Authorization' => "Bearer $this->admin_access_token",
        ];
        $payload = [];
        $this->json('delete', '/api/catalogues/DEFAULT', $payload, $header)
            ->assertStatus(404)
            ->assertJson([
                'success' => 'false',
                'message' => 'Catalogue does not exist.'
            ]);
    }

    public function testDeleteCatalogue()
    {
        $header = [
            'Authorization' => "Bearer $this->admin_access_token",
        ];
        $payload = [];
        $this->json('delete', '/api/catalogues/$DEFAULT', $payload, $header)
            ->assertStatus(200)
            ->assertJson([
                'success' => 'true',
                'message' => 'Catalogue was deleted.'
            ]);
    }
}
