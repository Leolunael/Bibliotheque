<?php

namespace src\services;

class UsersService implements IUsersService
{
    public function __construct(
        private UsersRepository $usersRepository,
        private ILogRepository $logRepository
    ){}

    function getUsers(): array
    {
        $users = [];
//        try{
//            $users = $this->usersRepository->findAll();
//            $this->insertLog(LogType::DEBUG, "Affichage", "Affichage de tout les étudiants");
//        } catch (PDOException $e) {
//            $this->insertLog(LogType::ERR, "Affichage", "Echec de l'affichage de tout les étudiants");
//            error_log("Erreur lors de findAll : " . $e->getMessage());
//        }
        return $users;
    }

    // Créé un étudiant et effectue des vérifications
    function createStudent(Student $studentToSave): bool
    {
        try {
            $this->studentRepository->save($studentToSave);
            $this->insertLog(LogType::DEBUG, "Création", "Création d'un étudiant");
            return true;
        } catch (PDOException $e) {
            error_log("Erreur lors de save : " . $e->getMessage());
            $this->insertLog(LogType::ERR, "Création", "Erreur lors de la création d'un étudiant");
            return false;
        }
    }

    // Permet d'éditer un étudiant
    function editUsers(Users $users): void
    {
        $id = $users->getId();
        $usersFound = $this->findUsersById($id);

        if($usersFound === null)
            return;

        try {
            $this->studentRepository->update($student);
            $this->insertLog(LogType::DEBUG, "Update", "Etudiant d'id ($id) mis à jour");
        } catch (PDOException $e) {
            error_log("Erreur lors de update : " . $e->getMessage());
            $this->insertLog(LogType::ERR, "Update", "Erreur pour l'étudiant d'id ($id) lors de la mis à jour");
        }
    }

    function deleteUsers(int $id): void
    {
        try{
            $this->usersRepository->deleteById($id);
            $this->insertLog(LogType::DEBUG, "Suppression", "Etudiant d'id ($id) supprimé");
        } catch (PDOException $e) {
            error_log("Erreur lors de deleteById : " . $e->getMessage());
            $this->insertLog(LogType::ERR, "Suppression", "Impossible de supprimer l'étudiant d'id ($id)");
        }
    }

    function findUsersByName(string $input): array {
        try{
            $students = $this->studentRepository->findAllByName($input);
            $this->insertLog(LogType::DEBUG, "Rechercher par nom", "Etudiant avec ($input) dans le nom trouvé");
            return $students;
        } catch (PDOException $e) {
            $this->insertLog(LogType::ERR, "Rechercher par nom", "Etudiant avec ($input) dans le nom introuvable");
            error_log("Erreur lors de findAllByName : " . $e->getMessage());
            return [];
        }
    }

    public function findStudentById(int $id): ?Student
    {
        try {
            // On récupère l'étudiant en base de données s'il existe
            $student = $this->studentRepository->findById($id);
            $this->insertLog(LogType::DEBUG, "Rechercher par ID", "Etudiant d'id ($id) trouvé");
        } catch (PDOException $e) {
            error_log("Erreur lors de findById : " . $e->getMessage());
            $this->insertLog(LogType::ERR, "Rechercher par ID", "Etudiant d'id ($id) introuvable");
            $student = null;
        }
        return $student;
    }
}