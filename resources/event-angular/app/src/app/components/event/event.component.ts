import { Component, OnInit } from '@angular/core';
// import { DataService } from 'src/app/service/data.service';
import { DataService } from '../../../app/service/data.service';
import { environment } from '../../../environments/environment';

@Component({
  selector: 'app-event',
  templateUrl: './event.component.html',
  styleUrl: './event.component.css',
})
export class EventComponent {
  events: any;

  constructor(private dataService: DataService) {}
  upload_url = environment.upload_url
  
  ngOnInit() {
    this.geteventsdata();
  }
  geteventsdata() {
    this.dataService.getEvents().subscribe((res) => {
      this.events = res;
    });
  }
}
