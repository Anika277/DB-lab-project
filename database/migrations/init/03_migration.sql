USE smart_library;
GO

-- migrations tracking table
IF NOT EXISTS (SELECT * FROM sysobjects WHERE name='migrations' AND xtype='U')
BEGIN
    CREATE TABLE migrations (
        id INT IDENTITY(1,1) PRIMARY KEY,
        migration NVARCHAR(255) NOT NULL,
        batch INT NOT NULL
    );
END
GO