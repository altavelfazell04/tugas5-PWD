CREATE TABLE peserta_seminar (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    institusi VARCHAR(100) NOT NULL,
    country VARCHAR(100) NOT NULL,
    address TEXT NOT NULL,
    jenis_kelamin ENUM('L', 'P') NOT NULL,
    thn_pendaftaran INT NOT NULL,
    jurusan VARCHAR(100)
);
