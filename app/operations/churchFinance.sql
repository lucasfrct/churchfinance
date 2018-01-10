#churchFinance

DROP DATABASE IF EXISTS churchfinance;

CREATE DATABASE IF NOT EXISTS churchfinance;

DROP TABLE IF EXISTS churchfinance.operations;

CREATE TABLE IF NOT EXISTS churchfinance.operations (
	id INT (11) UNIQUE AUTO_INCREMENT,
	date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	token VARCHAR (255) NOT NULL PRIMARY KEY,
	type BOOL DEFAULT 1 NOT NULL,
	value DOUBLE DEFAULT 0.0,
	caschier DOUBLE DEFAULT 0.0 NOT NULL,
    description LONGTEXT
);

INSERT INTO churchfinance.operations ( token, type, value, description ) 
	VALUES ( "AKW01AS4JHN100", 1, 50, "ação 1" );

INSERT INTO churchfinance.operations ( token, type, value, description ) 
	VALUES ( "AKW01AS4JHN70", 0, -30, "ação 2" );

INSERT INTO churchfinance.operations ( token, type, value, description ) 
	VALUES ( "AKW01AS4JHN270", 1, 100, "ação 3" );
