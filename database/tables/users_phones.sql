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

ALTER TABLE 'users_phones' 
  ADD 'phone_type_id' int(11) NOT NULL;

--
-- Cle etrangere sur users_phones`
--
ALTER TABLE `users_phones`
  ADD FOREIGN KEY (phone_type_id) REFERENCES phones_types(id);