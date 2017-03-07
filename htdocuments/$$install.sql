
DROP TABLE IF EXISTS xxxxxx;
DROP TABLE IF EXISTS xxxxxx;

CREATE TABLE xxxxxx
(
	id				char(36)		NOT NULL,
	valid_begin		date			NOT NULL,
	valid_end		date			NOT NULL,
	content			text			NOT	NULL,
	
	CONSTRAINT xxxxxx_pkey PRIMARY KEY (id)
);

CREATE INDEX id_ix ON xxxxxx (id);
ALTER TABLE xxxxxx DROP PRIMARY KEY;
