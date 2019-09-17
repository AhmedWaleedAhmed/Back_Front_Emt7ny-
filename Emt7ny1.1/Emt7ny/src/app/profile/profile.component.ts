import { Component, OnInit } from '@angular/core';
import { AuthService } from '../Services/auth.service';
import {  Router } from '@angular/router';
import { TokenService } from '../Services/token.service';

@Component({
  selector: 'app-profile',
  templateUrl: './profile.component.html',
  styleUrls: ['./profile.component.css']
})
export class ProfileComponent implements OnInit {
  name = 'مدرس';
  // 0->admin , 1->secretary , 2->teacher , 3->assistant , 4-> student
  /**
   * Type of logged-in user
   */
  type = 4;
  /**
   * New user type
   */
  newType = null;
  /**
   * New user name
   */
  newMemName = null;
  /**
   * New user email
   */
  newMemEmail = null;
  /**
   * New user password
   */
  newMemPassword = null;
  /**
   * Email to delete someone
   */
  deleteMemEmail = null;
  /**
   * Exam date to be available in
   */
  examDate: Date = null;

  constructor(
    private router: Router ,
    private Auth: AuthService,
    private token:TokenService,
  ) { }

  ngOnInit() {
  }

 /**
   * Admin
   */
  newMember() {
    alert('تم اضافة العضو: ' + this.newMemName + '\n بريد الكتروني: ' + this.newMemEmail + '\n و كلمة سر مبدئية: ' + this.newMemPassword);
  }
  deleteMember() {
    alert('تم الغاء العضو صاحب البريد: ' + this.deleteMemEmail);
  }
  /**
   * Secretary
   */
  addStudentToExam() {

  }
  /**
   * Teacher
   */
  editExam() {
    this.router.navigateByUrl('/previewExam/ahmed/1');
  }
  deleteExam() {

  }
  newExam() {
    this.router.navigateByUrl('/AddQuestion/5');
    console.log(this.examDate);
  }
  addAssistant() {
    
  }


  logout(event : MouseEvent){
    event.preventDefault();
    this.token.remove();
    this.Auth.changeAuthStatus(false);
    this.router.navigateByUrl('');
  }
}
