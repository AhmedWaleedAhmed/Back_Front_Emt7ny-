import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit {

  /**
   * For the forget password items
   */
  isShown: boolean = false;
  /**
   * For choosing between signup or login
   */
  login: boolean = true;
  constructor() { }

  ngOnInit() {
  }
  forgetPassword() {
    this.isShown = true;
  }
  chooseLogin() {
    this.login = true;
    this.isShown = false;
    document.getElementById("choose-login").style.backgroundColor = 'rgb(43, 164, 204)';
    document.getElementById("choose-signup").style.backgroundColor = '#343a40';
  }
  chooseSignup() {
    this.login = false;
    document.getElementById("choose-login").style.backgroundColor = '#343a40';
    document.getElementById("choose-signup").style.backgroundColor = 'rgb(43, 164, 204)';
  }
}
