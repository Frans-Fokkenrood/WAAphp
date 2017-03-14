
DROP TABLE IF EXISTS werknemer;

CREATE TABLE werknemer
(
	id				char(36)		NOT NULL,
	name			varchar(64)		NOT NULL,
	valid_begin		date			NOT NULL,
	valid_end		date			NOT NULL,
	content			text			NOT NULL,
	
	CONSTRAINT werknemer_pkey PRIMARY KEY (id)
);

CREATE INDEX id_ix ON werknemer (id);
ALTER TABLE werknemer DROP PRIMARY KEY;


DROP TABLE IF EXISTS werkgever;

CREATE TABLE werkgever
(
	id				char(36)		NOT NULL,
	name			varchar(64)		NOT NULL,
	valid_begin		date			NOT NULL,
	valid_end		date			NOT NULL,
	content			text			NOT NULL,
	
	CONSTRAINT werkgever_pkey PRIMARY KEY (id)
);

CREATE INDEX id_ix ON werkgever (id);
ALTER TABLE werkgever DROP PRIMARY KEY;


DROP TABLE IF EXISTS arbeidsovereenkomst;

CREATE TABLE arbeidsovereenkomst
(
	id				char(36)		NOT NULL,
	name			varchar(64)		NOT NULL,
	valid_begin		date			NOT NULL,
	valid_end		date			NOT NULL,
	content			text			NOT NULL,
	
	CONSTRAINT arbeidsovereenkomst_pkey PRIMARY KEY (id)
);

CREATE INDEX id_ix ON arbeidsovereenkomst (id);
ALTER TABLE arbeidsovereenkomst DROP PRIMARY KEY;


DROP TABLE IF EXISTS arbeidsduur;

CREATE TABLE arbeidsduur
(
	id				char(36)		NOT NULL,
	name			varchar(64)		NOT NULL,
	valid_begin		date			NOT NULL,
	valid_end		date			NOT NULL,
	content			text			NOT NULL,
	
	CONSTRAINT arbeidsduur_pkey PRIMARY KEY (id)
);

CREATE INDEX id_ix ON arbeidsduur (id);
ALTER TABLE arbeidsduur DROP PRIMARY KEY;

