-- Create database
IF NOT EXISTS (SELECT * FROM sys.databases WHERE name = 'smart_library')
BEGIN
    CREATE DATABASE smart_library;
END
GO

USE smart_library;
GO

-- Create users table
IF NOT EXISTS (SELECT * FROM sysobjects WHERE name='users' AND xtype='U')
BEGIN
    CREATE TABLE users (
        id BIGINT IDENTITY(1,1) PRIMARY KEY,
        name NVARCHAR(255) NOT NULL,
        email NVARCHAR(255) NOT NULL UNIQUE,
        password NVARCHAR(255) NOT NULL,
        created_at DATETIME2 DEFAULT GETDATE()
        
    );
END
GO

-- Create categories table
IF NOT EXISTS (SELECT * FROM sysobjects WHERE name='categories' AND xtype='U')
BEGIN
    CREATE TABLE categories (
        id BIGINT IDENTITY(1,1) PRIMARY KEY,
        name NVARCHAR(255) NOT NULL
      
       
    );
END
GO

-- Create books table
IF NOT EXISTS (SELECT * FROM sysobjects WHERE name='books' AND xtype='U')
BEGIN
    CREATE TABLE books (
        id BIGINT IDENTITY(1,1) PRIMARY KEY,
        title NVARCHAR(255) NOT NULL,
        author NVARCHAR(255) NOT NULL,
        cover_image NVARCHAR(500) NULL,
        category_id BIGINT NOT NULL,
        description NVARCHAR(MAX) NULL,
        available_copies INT DEFAULT 3
      FOREIGN KEY (category_id) REFERENCES categories(id)
    );
END
GO

-- Create borrows table
IF NOT EXISTS (SELECT * FROM sysobjects WHERE name='borrows' AND xtype='U')
BEGIN
    CREATE TABLE borrows (
        id BIGINT IDENTITY(1,1) PRIMARY KEY,
        user_id BIGINT NOT NULL,
        book_id BIGINT NOT NULL,
        borrowed_at DATETIME2 DEFAULT GETDATE(),
        returned_at DATETIME2 NULL,
        FOREIGN KEY (user_id) REFERENCES users(id),
        FOREIGN KEY (book_id) REFERENCES books(id)
    );
END
GO

-- Create personal_access_tokens table
IF NOT EXISTS (SELECT * FROM sysobjects WHERE name='personal_access_tokens' AND xtype='U')
BEGIN
    CREATE TABLE personal_access_tokens (
        id BIGINT IDENTITY(1,1) PRIMARY KEY,
        tokenable_type NVARCHAR(255) NOT NULL,
        tokenable_id BIGINT NOT NULL,
        name NVARCHAR(255) NOT NULL,
        token NVARCHAR(64) NOT NULL UNIQUE,
        abilities NVARCHAR(MAX) NULL,
        last_used_at DATETIME2 NULL,
        expires_at DATETIME2 NULL
       
       
    );
END
GO

GO

-- Create event_categories table
IF NOT EXISTS (SELECT * FROM sysobjects WHERE name='event_categories' AND xtype='U')
BEGIN
    CREATE TABLE event_categories (
        id BIGINT IDENTITY(1,1) PRIMARY KEY,
        name NVARCHAR(255) NOT NULL,
        slug NVARCHAR(255) NOT NULL UNIQUE,
        icon NVARCHAR(255) NULL,
        created_at DATETIME2 DEFAULT GETDATE()
        
    );
END
GO

-- Create rooms table
IF NOT EXISTS (SELECT * FROM sysobjects WHERE name='rooms' AND xtype='U')
BEGIN
    CREATE TABLE rooms (
        id BIGINT IDENTITY(1,1) PRIMARY KEY,
        name NVARCHAR(255) NOT NULL,
        capacity INT NOT NULL DEFAULT 20
       
       
    );
END
GO

-- Create events table
IF NOT EXISTS (SELECT * FROM sysobjects WHERE name='events' AND xtype='U')
BEGIN
    CREATE TABLE events (
        id BIGINT IDENTITY(1,1) PRIMARY KEY,
        title NVARCHAR(255) NOT NULL,
        description NVARCHAR(MAX) NULL,
        event_category_id BIGINT NOT NULL,
        room_id BIGINT NOT NULL,
        event_date DATE NOT NULL,
        event_time TIME NOT NULL,
        max_seats INT NOT NULL DEFAULT 20,
        status NVARCHAR(50) DEFAULT 'published',
        FOREIGN KEY (event_category_id) REFERENCES event_categories(id),
        FOREIGN KEY (room_id) REFERENCES rooms(id)
    );
END
GO

-- Create event_registrations table
IF NOT EXISTS (SELECT * FROM sysobjects WHERE name='event_registrations' AND xtype='U')
BEGIN
    CREATE TABLE event_registrations (
        id BIGINT IDENTITY(1,1) PRIMARY KEY,
        user_id BIGINT NOT NULL,
        event_id BIGINT NOT NULL,
        status NVARCHAR(50) DEFAULT 'confirmed',
        registered_at DATETIME2 DEFAULT GETDATE(),
        FOREIGN KEY (user_id) REFERENCES users(id),
        FOREIGN KEY (event_id) REFERENCES events(id),
        CONSTRAINT UQ_user_event UNIQUE (user_id, event_id)
    );
END
GO