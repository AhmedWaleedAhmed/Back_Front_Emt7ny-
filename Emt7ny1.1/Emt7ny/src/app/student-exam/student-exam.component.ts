import { Component, OnInit, ViewChild } from '@angular/core';
import { SignaturePad } from 'angular2-signaturepad/signature-pad';

@Component({
  selector: 'app-student-exam',
  templateUrl: './student-exam.component.html',
  styleUrls: ['./student-exam.component.css']
})
export class StudentExamComponent implements OnInit {

  constructor() { }
  @ViewChild(SignaturePad) signaturePad: SignaturePad;

  private signaturePadOptions: Object = {
    minWidth: 2,
    maxWidth: 2.5,
    canvasWidth: 684,
    canvasHeight: 600,
    penColor: 'rgb(66, 133, 244)'
  };
  img='../../assets/img/background.jpeg';
  fname = 'asd';
  lname = 'otta';
  f: number[] = [1, 0];
  ngOnInit() {
  }
  /**
   * Sending exam answer to back-end
   */
  submit() {
    console.log('first = ' + this.f[0]);
    console.log('second = ' + this.f[1]);
    this.img = this.signaturePad.toDataURL();
  }
  // tslint:disable-next-line: use-life-cycle-interface
  ngAfterViewInit() {
    // this.signaturePad is now available
    this.signaturePad.set('minWidth', 2); // set szimek/signature_pad options at runtime
    this.signaturePad.clear(); // invoke functions from szimek/signature_pad API
  }

   drawComplete() {
    // will be notified of szimek/signature_pad's onEnd event
    console.log(this.signaturePad.toDataURL());
  }

  drawStart() {
    // will be notified of szimek/signature_pad's onBegin event
    console.log('begin drawing');
  }

  clear() {
    this.signaturePad.clear();
  }

  erase() {
    this.signaturePad.set('penColor', 'white');
    this.signaturePad.set('minWidth', 8);
  }

  pen() {
    this.signaturePad.set('penColor', 'rgb(66, 133, 244)');
    this.signaturePad.set('minWidth', 2);
  }
  deleteExam() {
  }
}
