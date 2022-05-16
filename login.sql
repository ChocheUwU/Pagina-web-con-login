use login;

create table if not exists usuarios(
id int auto_increment primary key,
email varchar(20),
password varchar(20)
);

delimiter $$
create procedure sp_register(
_emial varchar(20),
_password varchar(20)
)
begin
insert into usuarios(email, password)values(_email, _password);
end
$$


