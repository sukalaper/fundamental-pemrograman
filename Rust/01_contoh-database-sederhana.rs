pub struct User{
  id: u64,
  name: String,
  email: String,
}

pub struct UserRepository{
}

impl UserRepository{
  pub fn new() -> UserRepository{
  }

  pub fn get_user_by_id(&self, id: u64) -> Option<User>{
  }

  pub fn save_user(&self, user: User){
}

  pub fn delete_user_by_id(&self, id: u64){
  }
}

pub struct UserService{
  user_repository: UserRepository,
}

impl UserService{
  pub fn new(user_repository: UserRepository) -> UserService{
    UserService {
      user_repository: user_repository,
    }
  }

  pub fn get_user_by_id(&self, id: u64) -> Option<User>{
    self.user_repository.get_user_by_id(id)
  }

  pub fn save_user(&self, user: User){
    self.user_repository.save_user(user)
  }

  pub fn delete_user_by_id(&self, id: u64){
    self.user_repository.delete_user_by_id(id)
  }
}

fn main() {
  let user_repository = UserRepository::new();
  let user_service = UserService::new(user_repository);
  let user = User {
    id: 1,
    name: String::from("Anggi"),
    email: String::from("anggirrr31@gmail.com"),
  };
  user_service.save_user(user);
  let user = user_service.get_user_by_id(1).unwrap();
  println!("User name: {}, email: {}", user.name, user.email);
}
