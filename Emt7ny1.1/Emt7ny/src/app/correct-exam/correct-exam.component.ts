import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-correct-exam',
  templateUrl: './correct-exam.component.html',
  styleUrls: ['./correct-exam.component.css']
})
export class CorrectExamComponent implements OnInit {

  img = '../../assets/img/background.jpeg';
  fname = 'asd';
  lname = 'otta';
  f: number[] = [1, 0];
  constructor() { }

  ngOnInit() { }

  submit() {

  }
check(value) {
   return value === 3;
}
}
