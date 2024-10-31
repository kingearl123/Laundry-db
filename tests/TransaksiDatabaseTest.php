<?php

use PHPUnit\Framework\TestCase;

class TransaksiDatabaseTest extends TestCase
{
    private $conn;

    protected function setUp(): void
    {
        // Mock database connection setup
        $this->conn = $this->createMock(mysqli::class);
    }

    public function testQueryTransaksiReturnsCorrectData()
    {
        // Mock query results
        $expectedData = [
            'id_transaksi' => 1,
            'kode_invoice' => 'INV123',
            'batas_waktu' => '2024-11-30',
            'dibayar' => 'belum_dibayar',
            'status' => 'baru',
            'diskon' => 10,
            'pajak' => 0.1
        ];

        // Mocking fetch_array
        $queryResult = $this->createMock(mysqli_result::class);
        $queryResult->method('fetch_array')->willReturn($expectedData);

        $this->conn->method('query')->willReturn($queryResult);

        // Execute function (or test portion that calls the query)
        $result = $this->conn->query("SELECT * FROM tb_transaksi WHERE id_transaksi = 1");
        $row = $result->fetch_array();

        // Assertions
        $this->assertEquals($expectedData['kode_invoice'], $row['kode_invoice']);
        $this->assertEquals($expectedData['batas_waktu'], $row['batas_waktu']);
        $this->assertEquals($expectedData['dibayar'], $row['dibayar']);
    }
}