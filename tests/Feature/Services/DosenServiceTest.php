<?php

namespace Tests\Feature\Services;

use App\Helper\Media;
use App\Http\Requests\DosenAddRequest;
use App\Http\Requests\DosenUpdateRequest;
use App\Models\Dosen;
use App\Services\DosenService;
use App\UseCase\DosenUC;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;
use function PHPUnit\Framework\assertSame;

class DosenServiceTest extends TestCase
{
    use RefreshDatabase, Media;

    private DosenService $dosenService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->dosenService = $this->app->make(DosenService::class);
    }


    public function test_dosen_provider()
    {
        self::assertTrue(true);
    }

    public function test_tambah_dosen()
    {
        $request = new DosenAddRequest([
            'nidn' => '111',
            'nama' => 'test',
            'tempat_lahir' => 'batang',
            'tanggal_lahir' => '2001-07-01',
            'nik' => '1607010001',
            'jenis_kelamin' => 'L',
            'nomer_hp' => '08544983934',
            'alamat' => 'rejosari, pranten, bawang, batang',
        ]);

        $this->dosenService->add($request);

        $this->assertDatabaseCount('dosen', 1);

        $this->assertDatabaseHas('dosen', [
           'nidn' => '111',
            'nama' => 'test',
            'tempat_lahir' => 'batang',
            'tanggal_lahir' => '2001-07-01',
            'nik' => '1607010001',
            'jenis_kelamin' => 'L',
            'nomer_hp' => '08544983934',
            'alamat' => 'rejosari, pranten, bawang, batang',
        ]);
    }

    public function test_list_dosen()
    {
        Dosen::factory(10)->create();

        $list1 = $this->dosenService->list();

        self::assertSame(10, $list1->count());

        Dosen::factory()->create(['nama' => 'test']);
        $list2 = $this->dosenService->list('test');
        assertSame(1, $list2->count());


        Dosen::factory(20)->create();
        $list3 = $this->dosenService->list('', 5);
        assertSame(5, $list3->count());

    }

    public function test_update_dosen()
    {
        $dosen = Dosen::factory()->create();

        $request = new DosenUpdateRequest([
            'nama' => 'test',
            'tempat_lahir' => 'batang',
            'tanggal_lahir' => '2001-07-01',
            'nik' => '1607010001',
            'jenis_kelamin' => 'P',
            'nomer_hp' => '08544983934',
            'alamat' => 'rejosari, pranten, bawang, batang',
        ]);

        $result = $this->dosenService->update($request, $dosen->nidn);

        self::assertNotSame($dosen->nama, $result->nama);
        self::assertNotSame($dosen->tempat_lahir, $result->tempat_lahir);
        self::assertNotSame($dosen->tanggal_lahir, $result->tanggal_lahir);
        self::assertNotSame($dosen->nik, $result->nik);
        self::assertNotSame($dosen->jenis_kelamin, $result->jenis_kelamin);
        self::assertNotSame($dosen->nomer_hp, $result->nomer_hp);
        self::assertNotSame($dosen->alamat, $result->alamat);

        $this->assertDatabaseCount('dosen', 1);

        $this->assertDatabaseHas('dosen', [
            'nama' => 'test',
            'tempat_lahir' => 'batang',
            'tanggal_lahir' => '2001-07-01',
            'nik' => '1607010001',
            'jenis_kelamin' => 'P',
            'nomer_hp' => '08544983934',
            'alamat' => 'rejosari, pranten, bawang, batang',
        ]);
    }

    public function test_delete_dosen_without_foto()
    {
        $dosen = Dosen::factory()->create();

        $this->assertDatabaseCount('dosen', 1);

        $this->dosenService->delete($dosen->nidn);

        $this->assertDatabaseCount('dosen', 0);
    }

    public function test_delete_dosen_with_foto(){
        $file = UploadedFile::fake()->create('file.pdf');
        $uploads = $this->uploads($file, 'test/');
        $dosen = Dosen::factory()->create(['foto_path' => public_path('storage/'. $uploads['filePath'])]);

        self::assertFileExists($dosen->foto_path);
        $this->assertDatabaseCount('dosen', 1);

        $this->dosenService->delete($dosen->nidn);

        $this->assertDatabaseCount('dosen', 0);
        self::assertFileDoesNotExist($dosen->foto_path);
    }

    public function test_add_image_success()
    {
        $dosen = Dosen::factory()->create();

        $image = UploadedFile::fake()->image('test.jpg');

        $result = $this->dosenService->addImage($dosen->nidn, $image);

        $this->assertDatabaseCount('dosen', 1);

        $this->assertDatabaseHas('dosen', [
            'foto_path' => $result->foto_path,
            'foto_url' => $result->foto_url,
        ]);

        self::assertFileExists($result->foto_path);

        @unlink($result->foto_path);
    }

    public function test_updata_image_success()
    {
        $file = UploadedFile::fake()->create('file.pdf');
        $uploads = $this->uploads($file, 'test/');
        $dosen = Dosen::factory()->create([
            'foto_path' => public_path('storage/'. $uploads['filePath']),
            'foto_url' => asset('storage/'. $uploads['filePath']),
        ]);

        $image = UploadedFile::fake()->image('test.jpg');

        self::assertFileExists($dosen->foto_path);
        $this->assertDatabaseCount('dosen', 1);

        $newImage = UploadedFile::fake()->image('test.jpg');

        $result = $this->dosenService->updateImage($dosen->nidn, $newImage);

        $this->assertDatabaseCount('dosen', 1);

        self::assertFileDoesNotExist($dosen->foto_path);

        self::assertFileExists($result->foto_path);

        self::assertNotSame($dosen->foto_path , $result->foto_path);
        self::assertNotSame($dosen->foto_url , $result->foto_url);

        @unlink($result->foto_path);

    }

    public function test_show_dosen_success()
    {
        $dosen = Dosen::factory()->create();

        $result = $this->dosenService->show($dosen->nidn);

        self::assertSame($dosen->nidn, $result->nidn);
        self::assertSame($dosen->nama, $result->nama);
        self::assertSame($dosen->nik, $result->nik);
        self::assertSame(1, $result->count());
    }


}

