CREATE SEQUENCE "states_id_seq" INCREMENT BY 1 MINVALUE 1 MAXVALUE 9223372036854775807 START WITH 1 CACHE 1;

-- Table: states
-- DROP TABLE states;
CREATE TABLE states (
  id INTEGER NOT NULL DEFAULT nextval('states_id_seq' :: regclass),
  name CHARACTER VARYING (255) UNIQUE NOT NULL,
  abbreviation CHARACTER (2) UNIQUE NOT NULL,
  capital CHARACTER VARYING (255) NOT NULL,
  cUF SMALLINT UNIQUE NOT NULL,
  CONSTRAINT states_pkey PRIMARY KEY (id)
) WITH (OIDS = FALSE);

ALTER TABLE
  states OWNER TO postgres;

INSERT INTO
  states (name, abbreviation, capital, cUF)
VALUES('Acre', 'AC', 'Rio Branco', 12);

INSERT INTO
  states (name, abbreviation, capital, cUF)
VALUES('Alagoas', 'AL', 'Maceió', 27);

INSERT INTO
  states (name, abbreviation, capital, cUF)
VALUES('Amapá', 'AP', 'Macapá', 16);

INSERT INTO
  states (name, abbreviation, capital, cUF)
VALUES('Amazonas', 'AM', 'Manaus', 13);

INSERT INTO
  states (name, abbreviation, capital, cUF)
VALUES('Bahia', 'BA', 'Salvador', 29);

INSERT INTO
  states (name, abbreviation, capital, cUF)
VALUES('Ceará', 'CE', 'Fortaleza', 23);

INSERT INTO
  states (name, abbreviation, capital, cUF)
VALUES('Distrito Federal', 'DF', 'Brasília', 53);

INSERT INTO
  states (name, abbreviation, capital, cUF)
VALUES('Espirito Santo', 'ES', 'Vitória', 32);

INSERT INTO
  states (name, abbreviation, capital, cUF)
VALUES('Goiás', 'GO', 'Goiânia', 52);

INSERT INTO
  states (name, abbreviation, capital, cUF)
VALUES('Maranhão', 'MA', 'São Luís', 21);

INSERT INTO
  states (name, abbreviation, capital, cUF)
VALUES('Mato Grosso', 'MT', 'Cuiabá', 51);

INSERT INTO
  states (name, abbreviation, capital, cUF)
VALUES('Mato Grosso do Sul', 'MS', 'Campo Grande', 50);

INSERT INTO
  states (name, abbreviation, capital, cUF)
VALUES('Minas Gerais', 'MG', 'Belo  Horizonte', 31);

INSERT INTO
  states (name, abbreviation, capital, cUF)
VALUES('Pará', 'PA', 'Belém', 15);

INSERT INTO
  states (name, abbreviation, capital, cUF)
VALUES('Paraíba', 'PB', 'João Pessoa', 25);

INSERT INTO
  states (name, abbreviation, capital, cUF)
VALUES('Paraná', 'PR', 'Curitiba', 41);

INSERT INTO
  states (name, abbreviation, capital, cUF)
VALUES('Pernambuco', 'PE', 'Recife', 26);

INSERT INTO
  states (name, abbreviation, capital, cUF)
VALUES('Piauí', 'PI', 'Teresina', 22);

INSERT INTO
  states (name, abbreviation, capital, cUF)
VALUES('Rio de Janeiro', 'RJ', 'Rio de Janeiro', 33);

INSERT INTO
  states (name, abbreviation, capital, cUF)
VALUES('Rio Grande do Norte', 'RN', 'Natal', 24);

INSERT INTO
  states (name, abbreviation, capital, cUF)
VALUES('Rio Grande do Sul', 'RS', 'Porto Alegre', 43);

INSERT INTO
  states (name, abbreviation, capital, cUF)
VALUES('Rondônia', 'RO', 'Porto Velho', 11);

INSERT INTO
  states (name, abbreviation, capital, cUF)
VALUES('Roraima', 'RR', 'Boa Vista', 14);

INSERT INTO
  states (name, abbreviation, capital, cUF)
VALUES('Santa Catarina', 'SC', 'Florianópolis', 42);

INSERT INTO
  states (name, abbreviation, capital, cUF)
VALUES('São Paulo', 'SP', 'São Paulo', 35);

INSERT INTO
  states (name, abbreviation, capital, cUF)
VALUES('Sergipe', 'SE', 'Aracaju', 28);

INSERT INTO
  states (name, abbreviation, capital, cUF)
VALUES('Tocantins', 'TO', 'Palmas', 17);