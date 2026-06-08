<div class="page-content">
  <div class="page-header">
      <div class="container-fluid">
          <h2 class="h5 no-margin-bottom">DashBoard</h2>
      </div>
  </div>
  
  <section class="no-padding-top">
      <div class="container-fluid">
          <div >
              @if(isset($reportData) && count($reportData) > 0)
              <div >
                  <table class="table ">
                      <thead class="report-table-header">
                          <tr>
                              <th>Month/Year</th>
                              <th>Total Bookings</th>
                              <th>Total Revenue </th>
                              <th>Regular Rooms</th>
                              <th>Premium Rooms</th>
                              <th>Deluxe Rooms</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach($reportData as $report)
                          <tr>
                              <td class="revenue-column">{{ $report['month_year'] }}</td>
                              <td>
                                  <span class="revenue-column" >
                                      {{ $report['total_bookings'] }}
                                  </span>
                              </td>
                              <td class="revenue-column">{{ $report['total_revenue'] }}</td>
                              <td>
                                  <span class="revenue-column">
                                      {{ $report['regular_rooms'] }}
                                  </span>
                              </td>
                              <td>
                                  <span class="revenue-column">
                                      {{ $report['premium_rooms'] }}
                                  </span>
                              </td>
                              <td>
                                  <span class="revenue-column">
                                      {{ $report['deluxe_rooms'] }}
                                  </span>
                              </td>
                          </tr>
                          @endforeach
                      </tbody>
                  </table>
              </div>
              @else
              <div class="no-report-data">
                  <i class="fa fa-inbox"></i>
                  <h4>No Booking Data</h4>
                  <p>Reports will appear when bookings are made.</p>
              </div>
              @endif
          </div>
      </div>
  </section>
</div>