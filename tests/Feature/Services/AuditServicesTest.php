<?php

namespace Tests\Feature\Services;

use App\Helper\Media;
use App\Http\Requests\AuditAddRequest;
use App\Http\Requests\AuditUpdateRequest;
use App\Models\Audit;
use App\Services\AuditService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class AuditServicesTest extends TestCase
{

    use RefreshDatabase, Media;

    private AuditService $auditService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->auditService = $this->app->make(AuditService::class);
    }

    public function test_provider()
    {
        self::assertTrue(true);
    }

    public function test_add_audit_success()
    {
        $request = new AuditAddRequest([
            'nama' => 'add test',
            'tahun' => 2020,
            'semester' => 1,
        ]);

        $this->auditService->add($request);

        $this->assertDatabaseCount('audit', 1);

        $this->assertDatabaseHas('audit', [
           'nama' => 'add test',
            'semester' => 1,
            'tahun' => 2020,
            'file_url' => null,
            'file_path' => null,
        ]);
    }

    public function test_list_audit()
    {
        Audit::factory(20)->create();

        $list = $this->auditService->list('', 10);

        self::assertSame(10, $list->count());

        Audit::factory()->create(['nama' => 'test']);

        $search = $this->auditService->list('test');

        self::assertSame(1, $search->count());

        $search = $this->auditService->list('salah');

        self::assertSame(0, $search->count());
    }

    public function test_update_audit_success()
    {
        $audit = Audit::factory()->create();

        $request = new AuditUpdateRequest([
            'nama' => 'update test',
            'tahun' => 9999,
            'semester' => 2,
        ]);

        $this->assertDatabaseCount('audit', 1);

        $result = $this->auditService->update($request, $audit->id);

        $this->assertDatabaseCount('audit', 1);

        self::assertNotSame($audit->nama, $result->nama);
        self::assertNotSame($audit->tahun, $result->tahun);
        self::assertNotSame($audit->semester, $result->semester);

        $this->assertDatabaseHas('audit', [
            'nama' => 'update test',
            'tahun' => 9999,
            'semester' => 2,
        ]);
    }

    public function test_delete_audit_withot_file_test()
    {
        $audit = Audit::factory()->create();

        $this->assertDatabaseCount('audit', 1);

        $this->auditService->delete($audit->id);

        $this->assertDatabaseCount('audit', 0);
    }

    public function test_delete_audot_with_file() {
        $file = UploadedFile::fake()->create('file.pdf');
        $uploads = $this->uploads($file, 'test/');
        $audit = Audit::factory()->create(['file_path' => public_path('storage/'. $uploads['filePath'])]);

        self::assertFileExists($audit->file_path);
        $this->assertDatabaseCount('audit', 1);

        $this->auditService->delete($audit->id);

        $this->assertDatabaseCount('audit', 0);
        self::assertFileDoesNotExist($audit->file_path);
    }

    public function test_add_file_audit_success()
    {
        $audit = Audit::factory()->create();

        $file = UploadedFile::fake()->create('file.pdf');

        $result = $this->auditService->addFile($file, $audit->id);

        $this->assertDatabaseCount('audit', 1);
        $this->assertDatabaseHas('audit', [
            'file_path' => $result->file_path,
            'file_url' => $result->file_url,
        ]);

        self::assertFileExists($result->file_path);

        @unlink($result->file_path);
    }

    public function test_delete_file_success()
    {

        $file = UploadedFile::fake()->create('file.pdf');
        $uploads = $this->uploads($file, 'test/');
        $audit = Audit::factory()->create([
            'file_path' => public_path('storage/' . $uploads['filePath']),
            'file_url' => 'url'
        ]);

        self::assertFileExists($audit->file_path);
        $this->assertDatabaseCount('audit', 1);

        $this->auditService->deleteFile($file, $audit->id);

        $this->assertDatabaseCount('audit', 1);
        self::assertFileDoesNotExist($audit->file_path);

    }

    public function test_update_file_succes()
    {
        $file = UploadedFile::fake()->create('file.pdf');
        $uploads = $this->uploads($file, 'test/');
        $audit = Audit::factory()->create([
            'file_path' => public_path('storage/' . $uploads['filePath']),
            'file_url' => 'url'
        ]);


        self::assertFileExists($audit->file_path);
        $this->assertDatabaseCount('audit', 1);

        $newFile = UploadedFile::fake()->create('file.pdf');
        $result = $this->auditService->updateFile($newFile, $audit->id);

        $this->assertDatabaseCount('audit', 1);

        self::assertFileDoesNotExist($audit->file_path);

        self::assertFileExists($result->file_path);

        self::assertNotSame($audit->file_path , $result->file_path);
        self::assertNotSame($audit->file_url , $result->file_url);

        @unlink($result->file_path);

    }

    public function test_show_pengumuman()
    {
        $audit = Audit::factory()->create([]);

        $result = $this->auditService->show($audit->id);

        self::assertSame($audit->judul, $result->judul);
        self::assertSame(1, $result->count());
    }
}
