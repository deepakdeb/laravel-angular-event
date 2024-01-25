import { Component, OnInit } from '@angular/core';
// import { DataService } from 'src/app/service/data.service';
import { DataService } from '../../../app/service/data.service';
@Component({
  selector: 'app-event',
  templateUrl: './event.component.html',
  styleUrl: './event.component.css',
})
export class EventComponent {
  events: any;
  constructor(private dataService: DataService) {}
  ngOnInit() {
    this.geteventsdata();
  }
  geteventsdata() {
    this.dataService.getData().subscribe((res) => {
      this.events = res;
    });
  }
}
