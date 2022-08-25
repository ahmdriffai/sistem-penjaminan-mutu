<?php

namespace Tests\Feature\Services;

use App\Helper\Media;
use App\Http\Requests\FileDokumenAddRequest;
use App\Http\Requests\FileDokumenRenameRequest;
use App\Models\DokumenMutu;
use App\Models\FileDokumen;
use App\Services\FileDokumenService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class FileDokumenServiceTest extends TestCase
{

    use RefreshDatabase, Media;

    private FileDokumenService $fileDokumenService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->fileDokumenService = $this->app->make(FileDokumenService::class);
    }


    public function test_provider()
    {
        self::assertTrue(true);
    }

    public function test_add_file_dokumen_success()
    {
        $dokumenMutu = DokumenMutu::factory()->create();
        $request = new FileDokumenAddRequest([
            'nama_file' => 'test',
        ]);

        $this->fileDokumenService->add($request, $dokumenMutu->id);

        $this->assertDatabaseCount('file_dokumen', 1);
        $this->assertDatabaseHas('file_dokumen', [
            'nama_file' => 'test',
            'file_url' => null,
            'file_path' => null,
            'format' => null,
            'dokumen_mutu_id' => $dokumenMutu->id,
        ]);

    }

    public function test_list_file_dokumen()
    {
        FileDokumen::factory(20)->create();

        $list = $this->fileDokumenService->list();

        self::assertSame(20, $list->count());

        $list = $this->fileDokumenService->list('salah');

        self::assertSame(0 , $list->count());

    }

    public function test_rename_success()
    {
        $fileDokumen = FileDokumen::factory()->create();
        $request = new FileDokumenRenameRequest([
            'nama_file' => 'rename file'
        ]);

        $result = $this->fileDokumenService->rename($request, $fileDokumen->id);

        $this->assertDatabaseCount('file_dokumen', 1);
        self::assertNotSame($fileDokumen->nama_file, $result->nama_file);
    }

    public function test_tambah_file_pengumuman_sukses()
    {
        $fileDokumen = FileDokumen::factory()->create();

        $file = UploadedFile::fake()->create('file.pdf', 1000);

        $result = $this->fileDokumenService->addFile($file, $fileDokumen->id);

        $this->assertDatabaseCount('file_dokumen', 1);
        $this->assertDatabaseHas('file_dokumen', [
            'file_path' => $result->file_path,
            'file_url' => $result->file_url,
            'format' => 'pdf',
        ]);

        self::assertFileExists($result->file_path);

        @unlink($result->file_path);
    }

    public function test_update_file_sukses()
    {
        $file = UploadedFile::fake()->create('file.pdf');
        $uploads = $this->uploads($file, 'test/');
        $fileDokumen = FileDokumen::factory()->create([
            'file_path' => public_path('storage/' . $uploads['filePath']),
            'file_url' => 'url',
            'format' => $uploads['fileType'],
        ]);


        self::assertFileExists($fileDokumen->file_path);
        $this->assertDatabaseCount('file_dokumen', 1);

        $newFile = UploadedFile::fake()->create('file.doc');
        $result = $this->fileDokumenService->updateFile($newFile, $fileDokumen->id);

        $this->assertDatabaseCount('file_dokumen', 1);

        $this->assertDatabaseHas('file_dokumen', [
            'format' => 'doc'
        ]);

        self::assertFileDoesNotExist($fileDokumen->file_path);

        self::assertFileExists($result->file_path);

        self::assertNotSame($fileDokumen->file_path , $result->file_path);
        self::assertNotSame($fileDokumen->file_url , $result->file_url);

        @unlink($result->file_path);

    }

    public function test_delete_file_success()
    {
        $file = UploadedFile::fake()->create('file.pdf');
        $uploads = $this->uploads($file, 'test/');
        $fileDokumen = FileDokumen::factory()->create([
            'file_path' => public_path('storage/' . $uploads['filePath']),
            'file_url' => 'url',
            'format' => $uploads['fileType'],
        ]);

        $this->assertDatabaseCount('file_dokumen', 1);

        $this->fileDokumenService->deleteFile($fileDokumen->id);

        $this->assertDatabaseCount('file_dokumen', 0);
    }


}
