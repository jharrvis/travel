    

<div class="container">
            <!-- Search Form -->
            <div class="search-form">
            <div class="form-row">
                <div class="form-group">
                    <label>Destination(s) or Hotel name</label>
                    <div class="location-input">
                        <input type="text" value="Dubai" placeholder="Enter destination">
                    </div>
                </div>
                <div class="form-group">
                    <label>Departure airport</label>
                    <select>
                        <option>Any airport</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>When</label>
                    <input type="text" value="Nov 2025" placeholder="Select dates">
                </div>
                <div class="form-group">
                    <label>How long</label>
                    <input type="text" value="5 nights" placeholder="Duration">
                </div>
                <div class="form-group">
                    <label>Room(s)</label>
                    <input type="text" value="1 Room / 2 Adults" placeholder="Rooms & guests">
                </div>
            </div>
        </div>

        <!-- Results Header -->
        <div class="results-header">
            <h1 class="results-title">15 holidays found</h1>
            <div class="sort-controls">
                <span>Sort by</span>
                <select class="sort-dropdown">
                    <option>Most popular</option>
                    <option>Price (low to high)</option>
                    <option>Price (high to low)</option>
                    <option>Star rating</option>
                </select>
                <button class="map-btn">🗺️ Map</button>
            </div>
        </div>

        <div class="content-wrapper">
            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Price Toggle -->
                <div class="filter-section">
                    <div class="price-toggle">
                        <span>Price Per Person</span>
                        <div class="toggle-switch"></div>
                        <span>Total Price</span>
                    </div>
                </div>

                <!-- Popular Filters -->
                <div class="filter-section">
                    <div class="filter-title" onclick="toggleFilter(this)">
                        Popular filters
                        <svg class="arrow" viewBox="0 0 24 24">
                            <path d="M7 10l5 5 5-5z"/>
                        </svg>
                    </div>
                    <div class="filter-content">
                        <div class="filter-tags">
                            <div class="filter-tag">5-star hotel</div>
                            <div class="filter-tag outline">4+ Tripadvisor rating</div>
                            <div class="filter-tag outline">Beach</div>
                        </div>
                    </div>
                </div>

                <!-- Promotions -->
                <div class="filter-section">
                    <div class="filter-title" onclick="toggleFilter(this)">
                        Promotions
                        <svg class="arrow" viewBox="0 0 24 24">
                            <path d="M7 10l5 5 5-5z"/>
                        </svg>
                    </div>
                    <div class="filter-content">
                        <div class="filter-list">
                            <div class="filter-item" onclick="toggleCheckbox(this)">
                                <div class="filter-item-left">
                                    <div class="filter-checkbox"></div>
                                    <span class="filter-label">Exclusive</span>
                                </div>
                            </div>
                            <div class="filter-item" onclick="toggleCheckbox(this)">
                                <div class="filter-item-left">
                                    <div class="filter-checkbox"></div>
                                    <span class="filter-label">Free child stays</span>
                                </div>
                                <div class="filter-count">1</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Popular Resorts -->
                <div class="filter-section">
                    <div class="filter-title" onclick="toggleFilter(this)">
                        Popular resorts
                        <svg class="arrow" viewBox="0 0 24 24">
                            <path d="M7 10l5 5 5-5z"/>
                        </svg>
                    </div>
                    <div class="filter-content">
                        <div class="filter-list">
                            <div class="filter-item" onclick="toggleCheckbox(this)">
                                <div class="filter-item-left">
                                    <div class="filter-checkbox"></div>
                                    <span class="filter-label">Dubai City</span>
                                </div>
                                <div class="filter-count">69</div>
                            </div>
                            <div class="filter-item" onclick="toggleCheckbox(this)">
                                <div class="filter-item-left">
                                    <div class="filter-checkbox"></div>
                                    <span class="filter-label">Downtown Dubai</span>
                                </div>
                                <div class="filter-count">23</div>
                            </div>
                            <div class="filter-item" onclick="toggleCheckbox(this)">
                                <div class="filter-item-left">
                                    <div class="filter-checkbox"></div>
                                    <span class="filter-label">The Palm Jumeirah</span>
                                </div>
                                <div class="filter-count">22</div>
                            </div>
                            <div class="filter-item" onclick="toggleCheckbox(this)">
                                <div class="filter-item-left">
                                    <div class="filter-checkbox checked"></div>
                                    <span class="filter-label">Jumeirah Beach</span>
                                </div>
                                <div class="filter-count">15</div>
                            </div>
                            <div class="filter-item" onclick="toggleCheckbox(this)">
                                <div class="filter-item-left">
                                    <div class="filter-checkbox"></div>
                                    <span class="filter-label">Dubai Marina</span>
                                </div>
                                <div class="filter-count">13</div>
                            </div>
                            <div class="filter-item" onclick="toggleCheckbox(this)">
                                <div class="filter-item-left">
                                    <div class="filter-checkbox"></div>
                                    <span class="filter-label">Jumeirah Beach Residence</span>
                                </div>
                                <div class="filter-count">13</div>
                            </div>
                            <div class="filter-item" onclick="toggleCheckbox(this)">
                                <div class="filter-item-left">
                                    <div class="filter-checkbox"></div>
                                    <span class="filter-label">Deira</span>
                                </div>
                                <div class="filter-count">10</div>
                            </div>
                            <div class="filter-item" onclick="toggleCheckbox(this)">
                                <div class="filter-item-left">
                                    <div class="filter-checkbox"></div>
                                    <span class="filter-label">Bur Dubai</span>
                                </div>
                                <div class="filter-count">8</div>
                            </div>
                            <div class="filter-item" onclick="toggleCheckbox(this)">
                                <div class="filter-item-left">
                                    <div class="filter-checkbox"></div>
                                    <span class="filter-label">Al Barsha</span>
                                </div>
                                <div class="filter-count">7</div>
                            </div>
                            <div class="filter-item" onclick="toggleCheckbox(this)">
                                <div class="filter-item-left">
                                    <div class="filter-checkbox"></div>
                                    <span class="filter-label">Jebel Ali</span>
                                </div>
                                <div class="filter-count">6</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Board Basis -->
                <div class="filter-section">
                    <div class="filter-title" onclick="toggleFilter(this)">
                        Board basis
                        <svg class="arrow" viewBox="0 0 24 24">
                            <path d="M7 10l5 5 5-5z"/>
                        </svg>
                    </div>
                    <div class="filter-content">
                        <div class="filter-list">
                            <div class="filter-item" onclick="toggleCheckbox(this)">
                                <div class="filter-item-left">
                                    <div class="filter-checkbox"></div>
                                    <span class="filter-label">All inclusive</span>
                                </div>
                            </div>
                            <div class="filter-item" onclick="toggleCheckbox(this)">
                                <div class="filter-item-left">
                                    <div class="filter-checkbox"></div>
                                    <span class="filter-label">Full board</span>
                                </div>
                            </div>
                            <div class="filter-item" onclick="toggleCheckbox(this)">
                                <div class="filter-item-left">
                                    <div class="filter-checkbox"></div>
                                    <span class="filter-label">Breakfast and dinner</span>
                                </div>
                            </div>
                            <div class="filter-item" onclick="toggleCheckbox(this)">
                                <div class="filter-item-left">
                                    <div class="filter-checkbox"></div>
                                    <span class="filter-label">Breakfast included</span>
                                </div>
                            </div>
                            <div class="filter-item" onclick="toggleCheckbox(this)">
                                <div class="filter-item-left">
                                    <div class="filter-checkbox"></div>
                                    <span class="filter-label">Self catering</span>
                                </div>
                            </div>
                            <div class="filter-item" onclick="toggleCheckbox(this)">
                                <div class="filter-item-left">
                                    <div class="filter-checkbox"></div>
                                    <span class="filter-label">Room only</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Star Rating -->
                <div class="filter-section">
                    <div class="filter-title" onclick="toggleFilter(this)">
                        Star rating
                        <svg class="arrow" viewBox="0 0 24 24">
                            <path d="M7 10l5 5 5-5z"/>
                        </svg>
                    </div>
                    <div class="filter-content">
                        <div class="filter-list">
                            <div class="filter-item" onclick="toggleCheckbox(this)">
                                <div class="filter-item-left">
                                    <div class="filter-checkbox checked"></div>
                                    <span class="filter-label">5-star hotel</span>
                                </div>
                                <div class="filter-count">15</div>
                            </div>
                            <div class="filter-item" onclick="toggleCheckbox(this)">
                                <div class="filter-item-left">
                                    <div class="filter-checkbox"></div>
                                    <span class="filter-label">4-star hotel</span>
                                </div>
                            </div>
                            <div class="filter-item" onclick="toggleCheckbox(this)">
                                <div class="filter-item-left">
                                    <div class="filter-checkbox"></div>
                                    <span class="filter-label">3-star hotel</span>
                                </div>
                                <div class="filter-count">1</div>
                            </div>
                            <div class="filter-item" onclick="toggleCheckbox(this)">
                                <div class="filter-item-left">
                                    <div class="filter-checkbox"></div>
                                    <span class="filter-label">2-star hotel</span>
                                </div>
                                <div class="filter-count">1</div>
                            </div>
                            <div class="filter-item" onclick="toggleCheckbox(this)">
                                <div class="filter-item-left">
                                    <div class="filter-checkbox"></div>
                                    <span class="filter-label">1-star hotel</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tripadvisor Score -->
                <div class="filter-section">
                    <div class="filter-title" onclick="toggleFilter(this)">
                        Tripadvisor score
                        <svg class="arrow" viewBox="0 0 24 24">
                            <path d="M7 10l5 5 5-5z"/>
                        </svg>
                    </div>
                    <div class="filter-content">
                        <div class="filter-list">
                            <div class="filter-item" onclick="toggleRadio(this, 'tripadvisor')">
                                <div class="filter-item-left">
                                    <div class="filter-radio checked" data-group="tripadvisor"></div>
                                    <span class="filter-label">Any</span>
                                </div>
                            </div>
                            <div class="filter-item" onclick="toggleRadio(this, 'tripadvisor')">
                                <div class="filter-item-left">
                                    <div class="filter-radio" data-group="tripadvisor"></div>
                                    <span class="filter-label">5</span>
                                </div>
                                <div class="filter-count">1</div>
                            </div>
                            <div class="filter-item" onclick="toggleRadio(this, 'tripadvisor')">
                                <div class="filter-item-left">
                                    <div class="filter-radio" data-group="tripadvisor"></div>
                                    <span class="filter-label">4.5 and above</span>
                                </div>
                                <div class="filter-count">12</div>
                            </div>
                            <div class="filter-item" onclick="toggleRadio(this, 'tripadvisor')">
                                <div class="filter-item-left">
                                    <div class="filter-radio" data-group="tripadvisor"></div>
                                    <span class="filter-label">4 and above</span>
                                </div>
                                <div class="filter-count">12</div>
                            </div>
                            <div class="filter-item" onclick="toggleRadio(this, 'tripadvisor')">
                                <div class="filter-item-left">
                                    <div class="filter-radio" data-group="tripadvisor"></div>
                                    <span class="filter-label">3.5 and above</span>
                                </div>
                                <div class="filter-count">12</div>
                            </div>
                            <div class="filter-item" onclick="toggleRadio(this, 'tripadvisor')">
                                <div class="filter-item-left">
                                    <div class="filter-radio" data-group="tripadvisor"></div>
                                    <span class="filter-label">3 and above</span>
                                </div>
                                <div class="filter-count">12</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Max Price -->
                <div class="filter-section">
                    <div class="filter-title" onclick="toggleFilter(this)">
                        Max price
                        <svg class="arrow" viewBox="0 0 24 24">
                            <path d="M7 10l5 5 5-5z"/>
                        </svg>
                    </div>
                    <div class="filter-content">
                        <div class="price-slider-container">
                            <div class="price-range-label">Any</div>
                            <div class="slider-wrapper">
                                <input type="range" class="price-slider" min="200" max="5000" value="5000" id="priceRange">
                                <div class="slider-track"></div>
                            </div>
                            <div class="price-range-values">
                                <span>£200</span>
                                <span>Any</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Holiday Type -->
                <div class="filter-section">
                    <div class="filter-title" onclick="toggleFilter(this)">
                        Holiday type
                        <svg class="arrow" viewBox="0 0 24 24">
                            <path d="M7 10l5 5 5-5z"/>
                        </svg>
                    </div>
                    <div class="filter-content">
                        <div class="filter-list">
                            <div class="filter-item" onclick="toggleCheckbox(this)">
                                <div class="filter-item-left">
                                    <div class="filter-checkbox"></div>
                                    <span class="filter-label">Adults Only Hotels</span>
                                </div>
                            </div>
                            <div class="filter-item" onclick="toggleCheckbox(this)">
                                <div class="filter-item-left">
                                    <div class="filter-checkbox"></div>
                                    <span class="filter-label">Beach</span>
                                </div>
                                <div class="filter-count">9</div>
                            </div>
                            <div class="filter-item" onclick="toggleCheckbox(this)">
                                <div class="filter-item-left">
                                    <div class="filter-checkbox"></div>
                                    <span class="filter-label">Close to Airport</span>
                                </div>
                            </div>
                            <div class="filter-item" onclick="toggleCheckbox(this)">
                                <div class="filter-item-left">
                                    <div class="filter-checkbox"></div>
                                    <span class="filter-label">Couples</span>
                                </div>
                                <div class="filter-count">10</div>
                            </div>
                            <div class="filter-item" onclick="toggleCheckbox(this)">
                                <div class="filter-item-left">
                                    <div class="filter-checkbox"></div>
                                    <span class="filter-label">Family</span>
                                </div>
                                <div class="filter-count">3</div>
                            </div>
                            <div class="filter-item" onclick="toggleCheckbox(this)">
                                <div class="filter-item-left">
                                    <div class="filter-checkbox"></div>
                                    <span class="filter-label">Honeymoon</span>
                                </div>
                                <div class="filter-count">2</div>
                            </div>
                            <div class="filter-item" onclick="toggleCheckbox(this)">
                                <div class="filter-item-left">
                                    <div class="filter-checkbox"></div>
                                    <span class="filter-label">Luxury Hotels</span>
                                </div>
                                <div class="filter-count">5</div>
                            </div>
                            <div class="filter-item" onclick="toggleCheckbox(this)">
                                <div class="filter-item-left">
                                    <div class="filter-checkbox"></div>
                                    <span class="filter-label">Spa and Relaxation</span>
                                </div>
                                <div class="filter-count">2</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Outbound Times -->
                <div class="filter-section">
                    <div class="filter-title" onclick="toggleFilter(this)">
                        Outbound times
                        <svg class="arrow" viewBox="0 0 24 24">
                            <path d="M7 10l5 5 5-5z"/>
                        </svg>
                    </div>
                    <div class="filter-content">
                        <div class="filter-list">
                            <div class="filter-item" onclick="toggleCheckbox(this)">
                                <div class="filter-item-left">
                                    <div class="filter-checkbox"></div>
                                    <div class="time-slot">
                                        <span class="filter-label">Morning</span>
                                        <span class="time-range">06:00-11:59</span>
                                    </div>
                                </div>
                            </div>
                            <div class="filter-item" onclick="toggleCheckbox(this)">
                                <div class="filter-item-left">
                                    <div class="filter-checkbox"></div>
                                    <div class="time-slot">
                                        <span class="filter-label">Afternoon</span>
                                        <span class="time-range">12:00-17:59</span>
                                    </div>
                                </div>
                            </div>
                            <div class="filter-item" onclick="toggleCheckbox(this)">
                                <div class="filter-item-left">
                                    <div class="filter-checkbox"></div>
                                    <div class="time-slot">
                                        <span class="filter-label">Evening</span>
                                        <span class="time-range">18:00-23:59</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Inbound Times -->
                <div class="filter-section">
                    <div class="filter-title" onclick="toggleFilter(this)">
                        Inbound times
                        <svg class="arrow" viewBox="0 0 24 24">
                            <path d="M7 10l5 5 5-5z"/>
                        </svg>
                    </div>
                    <div class="filter-content">
                        <div class="filter-list">
                            <div class="filter-item" onclick="toggleCheckbox(this)">
                                <div class="filter-item-left">
                                    <div class="filter-checkbox"></div>
                                    <div class="time-slot">
                                        <span class="filter-label">Morning</span>
                                        <span class="time-range">00:00-11:59</span>
                                    </div>
                                </div>
                            </div>
                            <div class="filter-item" onclick="toggleCheckbox(this)">
                                <div class="filter-item-left">
                                    <div class="filter-checkbox"></div>
                                    <div class="time-slot">
                                        <span class="filter-label">Afternoon</span>
                                        <span class="time-range">12:00-17:59</span>
                                    </div>
                                </div>
                            </div>
                            <div class="filter-item" onclick="toggleCheckbox(this)">
                                <div class="filter-item-left">
                                    <div class="filter-checkbox"></div>
                                    <div class="time-slot">
                                        <span class="filter-label">Evening</span>
                                        <span class="time-range">18:00-23:59</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Facilities -->
                <div class="filter-section">
                    <div class="filter-title" onclick="toggleFilter(this)">
                        Facilities
                        <svg class="arrow" viewBox="0 0 24 24">
                            <path d="M7 10l5 5 5-5z"/>
                        </svg>
                    </div>
                    <div class="filter-content">
                        <div class="filter-list">
                            <div class="filter-item" onclick="toggleCheckbox(this)">
                                <div class="filter-item-left">
                                    <div class="filter-checkbox"></div>
                                    <span class="filter-label">Air Conditioning</span>
                                </div>
                                <div class="filter-count">13</div>
                            </div>
                            <div class="filter-item" onclick="toggleCheckbox(this)">
                                <div class="filter-item-left">
                                    <div class="filter-checkbox"></div>
                                    <span class="filter-label">Bar</span>
                                </div>
                                <div class="filter-count">8</div>
                            </div>
                            <div class="filter-item" onclick="toggleCheckbox(this)">
                                <div class="filter-item-left">
                                    <div class="filter-checkbox"></div>
                                    <span class="filter-label">Beauty Treatments</span>
                                </div>
                                <div class="filter-count">6</div>
                            </div>
                            <div class="filter-item" onclick="toggleCheckbox(this)">
                                <div class="filter-item-left">
                                    <div class="filter-checkbox"></div>
                                    <span class="filter-label">Disabled Facilities</span>
                                </div>
                            </div>
                            <div class="filter-item" onclick="toggleCheckbox(this)">
                                <div class="filter-item-left">
                                    <div class="filter-checkbox"></div>
                                    <span class="filter-label">Gym</span>
                                </div>
                                <div class="filter-count">5</div>
                            </div>
                            <div class="filter-item" onclick="toggleCheckbox(this)">
                                <div class="filter-item-left">
                                    <div class="filter-checkbox"></div>
                                    <span class="filter-label">Massage</span>
                                </div>
                                <div class="filter-count">6</div>
                            </div>
                            <div class="filter-item" onclick="toggleCheckbox(this)">
                                <div class="filter-item-left">
                                    <div class="filter-checkbox"></div>
                                    <span class="filter-label">Satellite TV</span>
                                </div>
                                <div class="filter-count">2</div>
                            </div>
                            <div class="filter-item" onclick="toggleCheckbox(this)">
                                <div class="filter-item-left">
                                    <div class="filter-checkbox"></div>
                                    <span class="filter-label">WiFi</span>
                                </div>
                                <div class="filter-count">8</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pool -->
                <div class="filter-section">
                    <div class="filter-title" onclick="toggleFilter(this)">
                        Pool
                        <svg class="arrow" viewBox="0 0 24 24">
                            <path d="M7 10l5 5 5-5z"/>
                        </svg>
                    </div>
                    <div class="filter-content">
                        <div class="filter-list">
                            <div class="filter-item" onclick="toggleCheckbox(this)">
                                <div class="filter-item-left">
                                    <div class="filter-checkbox"></div>
                                    <span class="filter-label">Indoor Pool</span>
                                </div>
                            </div>
                            <div class="filter-item" onclick="toggleCheckbox(this)">
                                <div class="filter-item-left">
                                    <div class="filter-checkbox"></div>
                                    <span class="filter-label">Infinity Pool</span>
                                </div>
                            </div>
                            <div class="filter-item" onclick="toggleCheckbox(this)">
                                <div class="filter-item-left">
                                    <div class="filter-checkbox"></div>
                                    <span class="filter-label">Kids Pool</span>
                                </div>
                                <div class="filter-count">3</div>
                            </div>
                            <div class="filter-item" onclick="toggleCheckbox(this)">
                                <div class="filter-item-left">
                                    <div class="filter-checkbox"></div>
                                    <span class="filter-label">Outdoor Pool</span>
                                </div>
                            </div>
                            <div class="filter-item" onclick="toggleCheckbox(this)">
                                <div class="filter-item-left">
                                    <div class="filter-checkbox"></div>
                                    <span class="filter-label">Pool Bar</span>
                                </div>
                                <div class="filter-count">4</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Kids -->
                <div class="filter-section">
                    <div class="filter-title" onclick="toggleFilter(this)">
                        <div class="title-left">
                            <span>Kids</span>
                        </div>
                        <svg class="arrow" viewBox="0 0 24 24">
                            <path d="M7 10l5 5 5-5z"/>
                        </svg>
                    </div>
                    <div class="filter-content">
                        <div class="filter-list">
                            <div class="filter-item" onclick="toggleCheckbox(this)">
                                <div class="filter-item-left">
                                    <div class="filter-checkbox"></div>
                                    <span class="filter-label">Kids Club</span>
                                </div>
                                <div class="filter-count">14</div>
                            </div>
                            <div class="filter-item" onclick="toggleCheckbox(this)">
                                <div class="filter-item-left">
                                    <div class="filter-checkbox"></div>
                                    <span class="filter-label">Kids Pool</span>
                                </div>
                                <div class="filter-count">3</div>
                            </div>
                            <div class="filter-item" onclick="toggleCheckbox(this)">
                                <div class="filter-item-left">
                                    <div class="filter-checkbox"></div>
                                    <span class="filter-label">Playground</span>
                                </div>
                                <div class="filter-count">12</div>
                            </div>
                            <div class="filter-item" onclick="toggleCheckbox(this)">
                                <div class="filter-item-left">
                                    <div class="filter-checkbox"></div>
                                    <span class="filter-label">Theme Parks</span>
                                </div>
                            </div>
                            <div class="filter-item" onclick="toggleCheckbox(this)">
                                <div class="filter-item-left">
                                    <div class="filter-checkbox"></div>
                                    <span class="filter-label">Water Slides</span>
                                </div>
                                <div class="filter-count">5</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <?php
            // Load JSON data
            $jsonData = file_get_contents('dummy/hotels_data.json');
            $data = json_decode($jsonData, true);
            $hotels = $data['hotels'];

            // Function to generate star rating
            // function generateStars($stars) {
            //     return str_repeat('★', $stars);
            // }

            // Function to generate rating circles
            // function generateRatingCircles($rating) {
            //     $fullCircles = floor($rating);
            //     $circles = '';
            //     for ($i = 0; $i < $fullCircles; $i++) {
            //         $circles .= '<div class="rating-circle"></div>';
            //     }
            //     return $circles;
            // }

            // Function to get board basis icon
            function getBoardBasisIcon($boardBasis) {
                switch (strtolower($boardBasis)) {
                    case 'breakfast included':
                        return '🍽️';
                    case 'all inclusive':
                        return '🍽️';
                    case 'full board':
                        return '🍽️';
                    case 'room only':
                        return '🏨';
                    case 'self catering':
                        return '🍳';
                    default:
                        return '🍽️';
                }
            }
            ?>

            <!-- Hotel Listings -->
            <div class="hotel-list">
                <?php foreach ($hotels as $hotel): ?>
                    <div class="hotel-card">
                        <div class="hotel-image">
                            <img src="<?php echo htmlspecialchars($hotel['image']); ?>" alt="<?php echo htmlspecialchars($hotel['name']); ?>">
                            <div class="image-counter">1/<?php echo $hotel['imageCount']; ?></div>
                        </div>
                        <div class="hotel-info">
                            <div class="hotel-header">
                                <div>
                                    <h3 class="hotel-name"><?php echo htmlspecialchars($hotel['name']); ?></h3>
                                    <div class="hotel-stars"><?php echo generateStars($hotel['stars']); ?></div>
                                    <div class="hotel-location"><?php echo htmlspecialchars($hotel['location']); ?> • <?php echo htmlspecialchars($hotel['category']); ?></div>
                                </div>
                                <div class="heart-icon">♡</div>
                            </div>
                            
                            <div class="hotel-rating">
                                <?php echo generateRatingCircles($hotel['rating']); ?>
                                <span class="rating-text"><?php echo number_format($hotel['reviews']); ?> reviews</span>
                            </div>

                            <div class="hotel-details">
                                <span>📅 <?php echo htmlspecialchars($hotel['dates']); ?></span>
                                <span><?php echo getBoardBasisIcon($hotel['boardBasis']); ?> <?php echo htmlspecialchars($hotel['boardBasis']); ?></span>
                                <?php if ($hotel['flightsIncluded']): ?>
                                    <span>✈️ Flights included ⌄</span>
                                <?php endif; ?>
                            </div>

                            <div class="hotel-pricing">
                                <div class="pricing-left">
                                    <div class="deposit-info"><?php echo htmlspecialchars($hotel['deposit']); ?></div>
                                    <?php if (!empty($hotel['savings'])): ?>
                                        <div class="save-badge"><?php echo htmlspecialchars($hotel['savings']); ?></div>
                                    <?php endif; ?>
                                </div>
                                <div class="pricing-right">
                                    <?php if (!empty($hotel['originalPrice'])): ?>
                                        <div class="original-price"><?php echo htmlspecialchars($hotel['originalPrice']); ?></div>
                                    <?php endif; ?>
                                    <div class="current-price"><?php echo htmlspecialchars($hotel['currentPrice']); ?> <span class="price-note"><?php echo htmlspecialchars($hotel['priceNote']); ?></span></div>
                                </div>
                            </div>
                            
                            <button class="view-deal-btn" onclick="window.location.href='detail.php'">
                                <svg width="24" height="24" version="1.1" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                                    <path d="m23.349 16.244c0.06372-0.00125 0.12744-0.0025 0.18991-0.0025 1.8679 0 3.627 0.71375 4.9677 2.0212 1.3868 1.3525 2.1502 3.1638 2.1502 5.1 0 3.9288-3.1935 7.11-7.1317 7.1225-1.7767 0.00625-7.1054 0.045-7.1054 0.045v-6.9538c0-3.945 3.1085-7.2325 6.9293-7.3325m21.987-3.6525c-1.7442-3.0562-4.0494-5.5625-6.8518-7.45-2.74-1.8438-5.8548-3.1825-9.2582-3.9775-3.3035-0.77375-6.6331-1.1638-9.8979-1.1638h-19.328l0.099953 19.25c0.02124 4.2675 1.7055 8.2712 4.739 11.272 1.9766 1.955 4.373 3.3312 6.9817 4.0475 2.3139 0.445 4.4042 0.5525 4.6253 0.5625l7.0917-0.04625c6.462 0 11.718-5.2588 11.718-11.724 0-3.1875-1.2569-6.1688-3.5396-8.395-2.2814-2.225-5.295-3.405-8.486-3.3238-6.2908 0.16125-11.41 5.515-11.41 11.932v6.1438c-1.3844-0.55625-2.6563-1.3888-3.7495-2.4688-2.159-2.1375-3.3572-4.9875-3.3734-8.0262l-0.073715-14.625h14.704c2.9124 0 5.891 0.35125 8.8521 1.0438 2.8574 0.6675 5.4612 1.7838 7.7364 3.315 2.2102 1.4888 4.0356 3.4788 5.425 5.9125 1.3669 2.395 2.059 5.4662 2.059 9.1288 0 3.3762-0.69093 6.2888-2.0553 8.66-1.3981 2.4312-3.2347 4.4512-5.4599 6.0038-2.2864 1.595-4.9027 2.7925-7.7739 3.5575-2.9399 0.78125-5.8947 1.1788-8.7834 1.1788h-2.9074v-5.6625c-0.79088-0.03-3.4284-0.27125-4.6003-0.5675l0.0012495 10.83h7.5065c3.2885 0 6.6419-0.44875 9.9666-1.3338 3.3909-0.90125 6.4945-2.3238 9.2219-4.2288 2.7849-1.9425 5.0776-4.46 6.8156-7.4825 1.7704-3.0775 2.6675-6.765 2.6675-10.955 0-4.4725-0.89583-8.31-2.6638-11.409" fill-rule="evenodd"/>
                                </svg>
                                View deal
                            </button>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
</div>


<?php
// Load hotels data from JSON
$jsonFile = 'dummy/hotels_data.json';
$recentlyViewedHotels = [];

if (file_exists($jsonFile)) {
    $jsonData = file_get_contents($jsonFile);
    $data = json_decode($jsonData, true);
    if ($data && isset($data['hotels'])) {
        // Ambil 6 hotel pertama untuk recently viewed
        $recentlyViewedHotels = array_slice($data['hotels'], 0, 6);
    }
}

// Fallback data jika JSON tidak tersedia
if (empty($recentlyViewedHotels)) {
    $recentlyViewedHotels = [
        [
            'id' => 1,
            'name' => 'Radisson Beach Resort Palm Jumeirah',
            'location' => 'The Palm Jumeirah, Dubai, United Arab Emirates',
            'stars' => 4,
            'rating' => 4.2,
            'reviews' => 1104,
            'image' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=260&h=140&fit=crop'
        ],
        [
            'id' => 2,
            'name' => 'Dukes The Palm, a Royal Hideaway Hotel',
            'location' => 'The Palm Jumeirah, Dubai, United Arab Emirates',
            'stars' => 5,
            'rating' => 4.6,
            'reviews' => 4414,
            'image' => 'https://images.unsplash.com/photo-1582719508461-905c673771fd?w=260&h=140&fit=crop'
        ],
        [
            'id' => 3,
            'name' => 'Ibis London Heathrow Airport',
            'location' => 'London, England, United Kingdom',
            'stars' => 3,
            'rating' => 4.0,
            'reviews' => 6345,
            'image' => 'https://images.unsplash.com/photo-1551882547-ff40c63fe5fa?w=260&h=140&fit=crop'
        ],
        [
            'id' => 4,
            'name' => 'The Biltmore Hotel Villas',
            'location' => 'Al Barsha, Dubai, United Arab Emirates',
            'stars' => 5,
            'rating' => 4.8,
            'reviews' => 44,
            'image' => 'https://images.unsplash.com/photo-1564501049412-61c2a3083791?w=260&h=140&fit=crop'
        ],
        [
            'id' => 5,
            'name' => 'Four Seasons Resort Dubai',
            'location' => 'Jumeirah Beach, Dubai, United Arab Emirates',
            'stars' => 5,
            'rating' => 4.7,
            'reviews' => 2187,
            'image' => 'https://images.unsplash.com/photo-1584132967334-10e028bd69f7?w=260&h=140&fit=crop'
        ],
        [
            'id' => 6,
            'name' => 'Atlantis The Palm',
            'location' => 'The Palm Jumeirah, Dubai, United Arab Emirates',
            'stars' => 5,
            'rating' => 4.3,
            'reviews' => 8234,
            'image' => 'https://images.unsplash.com/photo-1571896349842-33c89424de2d?w=260&h=140&fit=crop'
        ]
    ];
}

// Function to generate stars
function generateStars($stars) {
    return str_repeat('★', $stars);
}

// Function to generate rating circles
function generateRatingCircles($rating) {
    $fullCircles = floor($rating);
    $circles = '';
    for ($i = 0; $i < $fullCircles; $i++) {
        $circles .= '<div class="recently-viewed-circle"></div>';
    }
    return $circles;
}
?>

<?php include 'recently-viewed.php'; ?>


    <script>
        // Toggle switch functionality
        document.querySelector('.toggle-switch').addEventListener('click', function() {
            this.classList.toggle('active');
        });

        // Filter tag functionality
        document.querySelectorAll('.filter-tag').forEach(tag => {
            tag.addEventListener('click', function() {
                this.classList.toggle('outline');
            });
        });

        // Heart icon functionality
        document.querySelector('.heart-icon').addEventListener('click', function() {
            this.innerHTML = this.innerHTML === '♡' ? '❤️' : '♡';
        });

        // Collapsible filter sections
        function toggleFilter(element) {
            const content = element.nextElementSibling;
            const arrow = element.querySelector('.arrow');
            
            element.classList.toggle('collapsed');
            content.classList.toggle('collapsed');
        }

        // Checkbox functionality
        function toggleCheckbox(filterItem) {
            const checkbox = filterItem.querySelector('.filter-checkbox');
            checkbox.classList.toggle('checked');
        }

        // Radio button functionality
        function toggleRadio(filterItem, groupName) {
            // Remove checked class from all radios in the same group
            const allRadios = document.querySelectorAll(`[data-group="${groupName}"]`);
            allRadios.forEach(radio => radio.classList.remove('checked'));
            
            // Add checked class to clicked radio
            const radio = filterItem.querySelector('.filter-radio');
            radio.classList.add('checked');
        }

        // Price slider functionality
        document.getElementById('priceRange').addEventListener('input', function() {
            const value = this.value;
            const max = this.max;
            const label = document.querySelector('.price-range-label');
            const rightValue = document.querySelector('.price-range-values span:last-child');
            
            if (value == max) {
                label.textContent = 'Any';
                rightValue.textContent = 'Any';
            } else {
                label.textContent = `Up to £${value}`;
                rightValue.textContent = `£${value}`;
            }
        });
    </script>
