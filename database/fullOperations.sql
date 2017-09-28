drop database merlen;
create database merlen;

use merlen;

--
-- Structure de la table `users`
--
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

INSERT INTO `users` (`id`, `firstname`, `lastname`) 
VALUES 
(1, "Luke", "Cage"), 
(2, "John", "Snow"), 
(3, "Luke", "Skywaller");


--
-- Structure de la table `phones_types`
--

CREATE TABLE `phones_types` (
  `id` int(11) NOT NULL,
  `slugPhoneType` varchar(20) NOT NULL
);

--
-- Index pour la table `phones_types`
--
ALTER TABLE `phones_types`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour la table `phones_types`
--
ALTER TABLE `phones_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

INSERT INTO `phones_types` (`id`, `slugPhoneType`) 
VALUES 
(1, "mobile"), 
(2, "fixed");

--
-- Structure de la table `users_phones`
--

CREATE TABLE `users_phones` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `phone_number` varchar(10) NOT NULL
);


-- Index pour la table `users_phones`
--
ALTER TABLE `users_phones`
  ADD PRIMARY KEY (`id`);


--
-- AUTO_INCREMENT pour la table `users_phones`
--
ALTER TABLE `users_phones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;


--
-- Cle etrangere sur user`
--
ALTER TABLE `users_phones`
  ADD FOREIGN KEY (user_id) REFERENCES users(id);


-- Skywalker fix
UPDATE users 
SET users.lastname = "Skywalker"
WHERE users.lastname LIKE "Skywaller";


-- slug fix
ALTER TABLE `phones_types` 
  CHANGE COLUMN `slugPhoneType` `slug` varchar(20) NOT NULL;


--
-- Cle etrangere sur users_phones`
--
ALTER TABLE `users_phones` 
  ADD `phone_type_id` int(11) NOT NULL;

ALTER TABLE `users_phones`
  ADD FOREIGN KEY (phone_type_id) REFERENCES phones_types(id);



INSERT INTO `users_phones` (`id`, `user_id`, `phone_number`, `phone_type_id`) 
VALUES 
(NULL, 1, "0600000001",1), 
(NULL, 1, "0600000002",1), 
(NULL, 2, "0600000003",2),
(NULL, 3, "0600000004",2);

SELECT users.*, users_phones.*
from users
inner join users_phones on users_phones.user_id = users.id;


SELECT count(*)
from users_phones;

SELECT users.*, count(users_phones.id) as "nb_phones"
from users
inner join users_phones on users_phones.user_id = users.id
group by users.id;


SELECT avg(nb_phones)
from (
	SELECT users.*, count(users_phones.id) as "nb_phones"
	from users
	inner join users_phones on users_phones.user_id = users.id
	group by users.id
) as nbPhoneByUser;