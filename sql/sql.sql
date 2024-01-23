#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: User
#------------------------------------------------------------

CREATE TABLE User(
        id_user    Int  Auto_increment  NOT NULL ,
        first_name Varchar (50) NOT NULL ,
        last_name  Varchar (50) NOT NULL ,
        email      Varchar (50) NOT NULL ,
        password   Varchar (255) NOT NULL
	,CONSTRAINT User_PK PRIMARY KEY (id_user)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: mystery_world
#------------------------------------------------------------

CREATE TABLE mystery_world(
        id_mystery_world Int  Auto_increment  NOT NULL ,
        world            Varchar (255) NOT NULL
	,CONSTRAINT mystery_world_PK PRIMARY KEY (id_mystery_world)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: User_World
#------------------------------------------------------------

CREATE TABLE User_World(
        id_mystery_world Int NOT NULL ,
        id_user          Int NOT NULL
	,CONSTRAINT User_World_PK PRIMARY KEY (id_mystery_world,id_user)

	,CONSTRAINT User_World_mystery_world_FK FOREIGN KEY (id_mystery_world) REFERENCES mystery_world(id_mystery_world)
	,CONSTRAINT User_World_User0_FK FOREIGN KEY (id_user) REFERENCES User(id_user)
)ENGINE=InnoDB;

INSERT INTO mystery_world (id_mystery_world, world)
VALUES (1, 'Vous êtes les meilleurs =) ');