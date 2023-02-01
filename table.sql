CREATE DATABASE dethicuoikiUITweb;

CREATE TABLE `DIEMCACHLY` (
    `MaDiemCachLy` VARCHAR(20) NOT NULL,
    `TenDiemCachLy` TEXT(20) NOT NULL,
    `DiaChi` TEXT(100) NOT NULL,
    `SucChua` INT(20) NOT NULL,
    PRIMARY KEY (`MaDiemCachLy`)
);
CREATE TABLE `CONGDAN` (
    `MaCongDan` VARCHAR(20) NOT NULL,
    `TenCongDan` TEXT(20) NOT NULL,
    `GioiTinh` BOOLEAN(20) NOT NULL,
    `NamSinh` DATE NOT NULL,
    `NuocVe` TEXT(20) NOT NULL,
    `MaDiemCachLy` VARCHAR(20) NOT NULL,
    PRIMARY KEY (`MaCongDan`),
    FOREIGN KEY (MaDiemCachLy) REFERENCES DIEMCACHLY(MaDiemCachLy)
);
CREATE TABLE `TRIEUCHUNG` (
    `MaTrieuChung` VARCHAR(20) NOT NULL,
    `TenTrieuChung` TEXT(20) NOT NULL,
    PRIMARY KEY (`MaTrieuChung`)
);
CREATE TABLE `CN_TC` (
    `MaCongDan` VARCHAR(20) NOT NULL,
    `MaTrieuChung` VARCHAR(20) NOT NULL,
    FOREIGN KEY (MaCongDan) REFERENCES CONGDAN(MaCongDan),
    FOREIGN KEY (MaTrieuChung) REFERENCES TRIEUCHUNG(MaTrieuChung)
);