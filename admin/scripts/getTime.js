var months = new Array(13);
                    months[0] = "January";
                    months[1] = "Febuary";
                    months[2] = "March";
                    months[3] = "April";
                    months[4] = "May";
                    months[5] = "June";
                    months[6] = "July";
                    months[7] = "August";
                    months[8] = "September";
                    months[9] = "October";
                    months[10] = "November";
                    months[11] = "December";

                    var now =  new Date();

                    var monthnumber = now.getMonth();
                    var monthname   = months[monthnumber];
                    var monthday    = now.getDate();
                    var year        = now.getYear();
                    if(year < 2000) { year = year + 1900; }
                    var dateString = monthname +
                                        ' ' +
                                        monthday +
                                        ', ' +
                                        year;
                    document.write("<div class='row'><div clas='col-md-12'><p class='pull-right'>Date is: " + dateString + "</p></div></div>");

                    function startClock() {
                        var time = new Date();
                        var pos = 'AM';
                        var hours = time.getHours();
                            if (hours >= 12) {
                                pos = 'PM';
                                var theTime = hours;
                                hours = theTime - 12;
                            }
                        var minutes = time.getMinutes();
                        var seconds = time.getSeconds();
                        var time = hours + ((minutes < 10) ? ":0" : ":") + minutes + ((seconds < 10) ? ":0" : ":") + seconds + " " + pos;
                        var theTarget = document.getElementById("theClock");
                        theTarget.innerHTML = "<p class='pull-right'>Time is: " + time + "</p>";
                    }
                    setInterval(startClock, 1000);