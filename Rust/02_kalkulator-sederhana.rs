pub struct Calculator{
}

impl Calculator{
  pub fn new() -> Calculator{
  }

  pub fn add(&self, a: i32, b: i32) -> i32{
    a + b
  }

  pub fn subtract(&self, a: i32, b: i32) -> i32{
    a - b
  }

  pub fn multiply(&self, a: i32, b: i32) -> i32{
    a * b
  }

  pub fn divide(&self, a: i32, b: i32) -> Option<i32>{
    if b == 0 {
      None
    } else {
      Some(a / b)
    }
  }
}

fn main(){
  let calculator = Calculator::new();
  let result = calculator.add(2, 3);
  println!("2 + 3 = {}", result);

  let result = calculator.subtract(5, 3);
  println!("5 - 3 = {}", result);

  let result = calculator.multiply(2, 3);
  println!("2 * 3 = {}", result);

  let result = calculator.divide(6, 3).unwrap();
  println!("6 / 3 = {}", result);

  let result = calculator.divide(6, 0);
  println!("6 / 0 = {:?}", result);
}
