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

ALTER TABLE 'phones_types' 
  CHANGE 'slugPhoneType' 'slug' varchar(20) NOT NULL