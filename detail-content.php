    <style>
        /* * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            color: #333;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        } */

        /* Tab Navigation */
        .tab-navigation {
            display: flex;
            margin-bottom: 30px;
            border-bottom: 1px solid #ddd;
        }

        .tab-item {
            padding: 12px 24px;
            background: none;
            border: none;
            border-bottom: 3px solid transparent;
            cursor: pointer;
            font-size: 16px;
            font-weight: 500;
            color: #666;
        }

        .tab-item.active {
            color: #333;
            border-bottom-color: #ac7872; //ac7872
        }

        /* Main Content */
        .content-wrapper {
            display: flex;
            gap: 30px;
        }

        /* Left Column */
        .left-column {
            flex: 1;
        }

        .section {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            margin-bottom: 30px;
            overflow: hidden;
        }

        .section-header {
            padding: 20px;
            border-bottom: 1px solid #eee;
            font-size: 18px;
            font-weight: bold;
        }

        .section-content {
            padding: 20px;
        }

        /* Hotel Image & Info */
        .hotel-main-info {
            position: relative;
        }

        .hotel-image-main {
            width: 100%;
            height: 200px;
            object-fit: cover;
            position: relative;
        }

        .image-counter {
            position: absolute;
            bottom: 15px;
            left: 50%;
            transform: translateX(-50%);
            background: rgba(0,0,0,0.7);
            color: white;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 500;
        }

        .heart-icon {
            position: absolute;
            top: 15px;
            right: 15px;
            background: white;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            cursor: pointer;
            box-shadow: 0 2px 8px rgba(0,0,0,0.15);
        }

        .hotel-info-content {
            padding: 20px;
        }

        .hotel-stars {
            color: #ffa500;
            margin-bottom: 8px;
            font-size: 16px;
        }

        .hotel-name {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .hotel-location {
            color: #666;
            margin-bottom: 15px;
        }

        .hotel-rating {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
        }

        .rating-circle {
            width: 12px;
            height: 12px;
            background: #153b3c;
            border-radius: 50%;
        }

        .rating-text {
            color: #666;
            font-size: 14px;
        }

        /* Form Fields */
        .form-field {
            margin-bottom: 15px;
        }

        .form-field input, .form-field select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
        }

        .guarantee-box {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .guarantee-icon {
            color: #153b3c;
            font-size: 18px;
        }

        .guarantee-text {
            font-size: 14px;
        }

        .guarantee-title {
            font-weight: bold;
            margin-bottom: 2px;
        }

        /* Calendar Section */
        .calendar-section {
            padding: 20px;
        }

        .calendar-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .selected-date {
            font-size: 16px;
            font-weight: bold;
        }

        .month-navigation {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .nav-btn {
            background: none;
            border: 1px solid #ddd;
            border-radius: 50%;
            width: 35px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .month-year {
            font-size: 16px;
            font-weight: 500;
            min-width: 120px;
            text-align: center;
        }

        .calendar-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 1px;
            background: #eee;
            border-radius: 8px;
            overflow: hidden;
            margin-bottom: 20px;
        }

        .calendar-header-cell {
            background: #f8f9fa;
            padding: 12px 8px;
            text-align: center;
            font-size: 14px;
            font-weight: 500;
            color: #666;
        }

        .calendar-cell {
            background: white;
            padding: 12px 8px;
            text-align: center;
            cursor: pointer;
            position: relative;
            min-height: 60px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .calendar-cell:hover {
            background: #f8f9fa;
        }

        .calendar-cell.selected {
            background: #153b3c;
            color: white;
        }

        .calendar-cell.other-month {
            color: #ccc;
        }

        .date-number {
            font-weight: bold;
            margin-bottom: 2px;
        }

        .date-price {
            font-size: 11px;
            color: #666;
        }

        .calendar-cell.selected .date-price {
            color: white;
        }

        .price-toggle {
            display: flex;
            align-items: center;
            gap: 10px;
            justify-content: center;
        }

        .toggle-switch {
            width: 50px;
            height: 25px;
            background: #ddd;
            border-radius: 25px;
            position: relative;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .toggle-switch.active {
            background: #ac7872;
        }

        .toggle-switch::after {
            content: '';
            position: absolute;
            width: 21px;
            height: 21px;
            background: white;
            border-radius: 50%;
            top: 2px;
            left: 2px;
            transition: 0.3s;
        }

        .toggle-switch.active::after {
            left: 27px;
        }

        .cheapest-indicator {
            background: #153b3c;
            color: white;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: bold;
            margin-top: 10px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        /* Right Column */
        .right-column {
            width: 350px;
            flex-shrink: 0;
        }

        .offer-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        .offer-header {
            background: #ac7872;
            color: white;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .offer-title {
            font-weight: bold;
        }

        .best-offer-badge {
            background: rgba(255,255,255,0.2);
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
        }

        .offer-content {
            padding: 20px;
        }

        .hotel-offer-name {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .offer-details {
            color: #666;
            font-size: 14px;
            margin-bottom: 20px;
        }

        .flight-info {
            margin-bottom: 20px;
        }

        /* Flight Information Styles */
        .flight-segment-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
        }

        .flight-segment-left {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .flight-icon {
            font-size: 14px;
            width: 16px;
        }

        .flight-segment-details {
            display: flex;
            flex-direction: column;
        }

        .flight-date {
            font-weight: bold;
            font-size: 14px;
            color: #333;
        }

        .flight-direction {
            font-size: 12px;
            color: #666;
        }

        .flight-segment-right {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 2px;
        }

        .airline-logo-small {
            width: 62px;
            height: 20px;
            object-fit: contain;
        }

        .flight-number-small {
            font-size: 12px;
            color: #666;
        }

        .flight-times-detail {
            margin-left: 24px;
            margin-bottom: 15px;
        }

        .flight-time-item {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 8px;
        }

        .time-dot {
            width: 6px;
            height: 6px;
            background-color: #333;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .time-info {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .time {
            font-weight: bold;
            font-size: 14px;
            color: #333;
            min-width: 50px;
        }

        .airport {
            color: #666;
            font-size: 14px;
        }

        .flight-duration-detail {
            display: flex;
            align-items: center;
            gap: 6px;
            margin: 8px 0 8px 18px;
            font-size: 12px;
            color: #666;
        }

        .duration-icon {
            font-size: 12px;
        }

        .duration-text {
            font-weight: 500;
        }

        .stops-info {
            margin-left: 4px;
        }

        .stop-icon {
            margin-left: 4px;
            font-size: 10px;
        }

        .flight-segment {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }

        .flight-segment:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .flight-date {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .airline-logo {
            width: 24px;
            height: 24px;
            background: #ac7872;
            border-radius: 4px;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: bold;
        }

        .flight-details {
            flex: 1;
        }

        .flight-time {
            font-weight: bold;
        }

        .flight-route {
            font-size: 12px;
            color: #666;
        }

        .flight-duration {
            font-size: 12px;
            color: #666;
        }

        .protection-badges {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-bottom: 20px;
        }

        .protection-badge {
            background: #f8f9fa;
            border: 1px solid #ddd;
            padding: 6px 10px;
            border-radius: 15px;
            font-size: 12px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .pricing-summary {
            border-top: 1px solid #eee;
            padding-top: 20px;
        }

        .price-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .price-row.total {
            font-weight: bold;
            font-size: 18px;
            border-top: 1px solid #eee;
            padding-top: 15px;
            margin-top: 15px;
        }

        .original-price {
            text-decoration: line-through;
            color: #999;
            font-size: 14px;
        }

        .secure-today {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            margin: 20px 0;
        }

        .secure-price {
            font-weight: bold;
            font-size: 16px;
        }

        .payment-options {
            margin: 15px 0;
        }

        .payment-dropdown {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 6px;
            background: white;
        }

        .select-btn {
            width: 100%;
            background: #153b3c;
            color: white;
            border: none;
            padding: 15px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            margin-bottom: 15px;
        }

        .alternative-btn {
            width: 100%;
            background: white;
            color: #333;
            border: 2px solid #ddd;
            padding: 15px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }

        .further-charges {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #eee;
        }

        .charges-title {
            font-weight: bold;
            margin-bottom: 10px;
        }

        .charges-text {
            font-size: 14px;
            color: #666;
        }

        @media (max-width: 1024px) {
            .content-wrapper {
                flex-direction: column;
            }
            
            .left-column, .right-column {
                width: 100%;
            }
        }

        @media (max-width: 768px) {
            .calendar-grid {
                font-size: 12px;
            }
            
            .calendar-cell {
                min-height: 50px;
                padding: 8px 4px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Tab Navigation -->
        <div class="tab-navigation">
            <button class="tab-item active">Flights + Hotel</button>
            <button class="tab-item">Hotel only</button>
        </div>

        <div class="content-wrapper">
            <!-- Left Column -->
            <div class="left-column">
                <!-- Hotel Information -->
                <div class="section hotel-main-info">
                    <div style="position: relative;">
                        <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?w=400&h=200&fit=crop" alt="Jumeirah Beach Hotel" class="hotel-image-main">
                        <div class="image-counter">1/86</div>
                        <div class="heart-icon">♡</div>
                    </div>
                    <div class="hotel-info-content">
                        <div class="hotel-stars">★★★★★</div>
                        <h1 class="hotel-name">Jumeirah Beach Hotel</h1>
                        <div class="hotel-location">Jumeirah Beach, Dubai, United Arab Emirates</div>
                        <div class="hotel-rating">
                            <div class="rating-circle"></div>
                            <div class="rating-circle"></div>
                            <div class="rating-circle"></div>
                            <div class="rating-circle"></div>
                            <div class="rating-circle"></div>
                            <span class="rating-text">5,124 reviews</span>
                        </div>
                        <div style="display: flex; gap: 15px; margin-bottom: 20px;">
                            <span style="color: #ac7872; text-decoration: underline; cursor: pointer;">Hotel details</span>
                            <span style="color: #ac7872; text-decoration: underline; cursor: pointer;">🗺️ Map</span>
                        </div>
                    </div>
                </div>

                <!-- Refine Your Holiday -->
                <div class="section">
                    <div class="section-header">Refine your holiday</div>
                    <div class="section-content">
                        <div class="form-field">
                            <input type="text" value="✈️ Any airport" readonly>
                        </div>
                        <div class="form-field">
                            <input type="text" value="🌙 5 nights" readonly>
                        </div>
                        <div class="form-field">
                            <input type="text" value="🍽️ Any board basis" readonly>
                        </div>
                        <div class="form-field">
                            <input type="text" value="👥 1 Room / 2 Adults" readonly>
                        </div>
                        <div class="form-field">
                            <input type="text" value="✈️ Any flight time" readonly>
                        </div>
                        
                        <div class="guarantee-box">
                            <div class="guarantee-icon">✓</div>
                            <div class="guarantee-text">
                                <div class="guarantee-title">Price Match Guarantee</div>
                                <div>We won't be beaten on price</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Middle Column - Calendar -->
            <div class="middle-column">
                <div class="section">
                    <div class="section-header">Price & Availability</div>
                    <div class="calendar-section">
                        <div class="calendar-header">
                            <div class="selected-date">Selected Date: Sun 30 Nov 2025</div>
                        </div>
                        
                        <div class="month-navigation">
                            <button class="nav-btn">‹</button>
                            <div class="month-year">November 2025</div>
                            <button class="nav-btn">›</button>
                        </div>

                        <div class="calendar-grid">
                            <div class="calendar-header-cell">Mo</div>
                            <div class="calendar-header-cell">Tu</div>
                            <div class="calendar-header-cell">We</div>
                            <div class="calendar-header-cell">Th</div>
                            <div class="calendar-header-cell">Fr</div>
                            <div class="calendar-header-cell">Sa</div>
                            <div class="calendar-header-cell">Su</div>
                            
                            <!-- Week 1 -->
                            <div class="calendar-cell other-month"></div>
                            <div class="calendar-cell other-month"></div>
                            <div class="calendar-cell other-month"></div>
                            <div class="calendar-cell other-month"></div>
                            <div class="calendar-cell other-month"></div>
                            <div class="calendar-cell">
                                <div class="date-number">1</div>
                                <div class="date-price">£2,019</div>
                            </div>
                            <div class="calendar-cell">
                                <div class="date-number">2</div>
                                <div class="date-price">£1,999</div>
                            </div>
                            
                            <!-- Week 2 -->
                            <div class="calendar-cell">
                                <div class="date-number">3</div>
                                <div class="date-price">£1,759</div>
                            </div>
                            <div class="calendar-cell">
                                <div class="date-number">4</div>
                                <div class="date-price">£1,749</div>
                            </div>
                            <div class="calendar-cell">
                                <div class="date-number">5</div>
                                <div class="date-price">£1,749</div>
                            </div>
                            <div class="calendar-cell">
                                <div class="date-number">6</div>
                                <div class="date-price">£1,729</div>
                            </div>
                            <div class="calendar-cell">
                                <div class="date-number">7</div>
                                <div class="date-price">£1,779</div>
                            </div>
                            <div class="calendar-cell">
                                <div class="date-number">8</div>
                                <div class="date-price">£1,769</div>
                            </div>
                            <div class="calendar-cell">
                                <div class="date-number">9</div>
                                <div class="date-price">£1,579</div>
                            </div>
                            
                            <!-- Week 3 -->
                            <div class="calendar-cell">
                                <div class="date-number">10</div>
                                <div class="date-price">£1,599</div>
                            </div>
                            <div class="calendar-cell">
                                <div class="date-number">11</div>
                                <div class="date-price">£1,559</div>
                            </div>
                            <div class="calendar-cell">
                                <div class="date-number">12</div>
                                <div class="date-price">£1,559</div>
                            </div>
                            <div class="calendar-cell">
                                <div class="date-number">13</div>
                                <div class="date-price">£1,559</div>
                            </div>
                            <div class="calendar-cell">
                                <div class="date-number">14</div>
                                <div class="date-price">£1,599</div>
                            </div>
                            <div class="calendar-cell">
                                <div class="date-number">15</div>
                                <div class="date-price">£1,579</div>
                            </div>
                            <div class="calendar-cell">
                                <div class="date-number">16</div>
                                <div class="date-price">£1,599</div>
                            </div>
                            
                            <!-- Week 4 -->
                            <div class="calendar-cell">
                                <div class="date-number">17</div>
                                <div class="date-price">£1,579</div>
                            </div>
                            <div class="calendar-cell">
                                <div class="date-number">18</div>
                                <div class="date-price">£1,569</div>
                            </div>
                            <div class="calendar-cell">
                                <div class="date-number">19</div>
                                <div class="date-price">£1,559</div>
                            </div>
                            <div class="calendar-cell">
                                <div class="date-number">20</div>
                                <div class="date-price">£1,559</div>
                            </div>
                            <div class="calendar-cell">
                                <div class="date-number">21</div>
                                <div class="date-price">£1,579</div>
                            </div>
                            <div class="calendar-cell">
                                <div class="date-number">22</div>
                                <div class="date-price">£1,599</div>
                            </div>
                            <div class="calendar-cell">
                                <div class="date-number">23</div>
                                <div class="date-price">£1,599</div>
                            </div>
                            
                            <!-- Week 5 -->
                            <div class="calendar-cell">
                                <div class="date-number">24</div>
                                <div class="date-price">£1,599</div>
                            </div>
                            <div class="calendar-cell">
                                <div class="date-number">25</div>
                                <div class="date-price">£1,569</div>
                            </div>
                            <div class="calendar-cell">
                                <div class="date-number">26</div>
                                <div class="date-price">£1,559</div>
                            </div>
                            <div class="calendar-cell">
                                <div class="date-number">27</div>
                                <div class="date-price">£1,569</div>
                            </div>
                            <div class="calendar-cell">
                                <div class="date-number">28</div>
                                <div class="date-price">£1,509</div>
                            </div>
                            <div class="calendar-cell">
                                <div class="date-number">29</div>
                                <div class="date-price">£1,509</div>
                            </div>
                            <div class="calendar-cell selected">
                                <div class="date-number">30</div>
                                <div class="date-price">£1,459</div>
                            </div>
                        </div>

                        <div class="price-toggle">
                            <span>Price Per Person</span>
                            <div class="toggle-switch"></div>
                            <span>Total Price</span>
                        </div>

                        <div class="cheapest-indicator">
                            <span>£</span>
                            <span>= Cheapest</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="right-column">
                <div class="offer-card">
                    <div class="offer-header">
                        <div class="offer-title">Flight & Hotel Offer</div>
                        <div class="best-offer-badge">Best Offer</div>
                    </div>
                    
                    <div class="offer-content">
                        <div class="hotel-offer-name">Jumeirah Beach Hotel</div>
                        <div class="offer-details">Sun 30 Nov 2025 (5 nights)<br>Breakfast included</div>
                       
                        <!-- Flight Information -->
                        <div class="flight-info">
                            <!-- Outbound Flight -->
                            <div class="flight-segment-header">
                                <div class="flight-segment-left">
                                    <span class="flight-icon">✈️</span>
                                    <div class="flight-segment-details">
                                        <div class="flight-date">Sun 30 Nov 2025</div>
                                        <div class="flight-direction">Outbound</div>
                                    </div>
                                </div>
                                <div class="flight-segment-right">
                                    <img src="https://airhex.com/images/airline-logos/alt/ajet.png" 
                                        alt="Jet2" 
                                        class="airline-logo-small">
                                    <div class="flight-number-small">VF1988</div>
                                </div>
                            </div>
                            
                            <div class="flight-times-detail">
                                <div class="flight-time-item">
                                    <div class="time-dot"></div>
                                    <div class="time-info">
                                        <span class="time">12:35</span>
                                        <span class="airport">London Stansted (STN)</span>
                                    </div>
                                </div>
                                
                                <div class="flight-duration-detail">
                                    <span class="duration-icon">⏱️</span>
                                    <span class="duration-text">11h 15m</span>
                                    <span class="stops-info">1 stop</span>
                                    <span class="stop-icon">●</span>
                                </div>
                                
                                <div class="flight-time-item">
                                    <div class="time-dot"></div>
                                    <div class="time-info">
                                        <span class="time">03:50+1</span>
                                        <span class="airport">Dubai (DXB)</span>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Inbound Flight -->
                            <div class="flight-segment-header" style="margin-top: 20px;">
                                <div class="flight-segment-left">
                                    <span class="flight-icon">🛬</span>
                                    <div class="flight-segment-details">
                                        <div class="flight-date">Fri 5 Dec 2025</div>
                                        <div class="flight-direction">Inbound</div>
                                    </div>
                                </div>
                                <div class="flight-segment-right">
                                    <img src="https://airhex.com/images/airline-logos/alt/ajet.png" 
                                        alt="Jet2" 
                                        class="airline-logo-small">
                                    <div class="flight-number-small">VF550</div>
                                </div>
                            </div>
                            
                            <div class="flight-times-detail">
                                <div class="flight-time-item">
                                    <div class="time-dot"></div>
                                    <div class="time-info">
                                        <span class="time">06:00</span>
                                        <span class="airport">Dubai (DXB)</span>
                                    </div>
                                </div>
                                
                                <div class="flight-duration-detail">
                                    <span class="duration-icon">⏱️</span>
                                    <span class="duration-text">12h 35m</span>
                                    <span class="stops-info">1 stop</span>
                                    <span class="stop-icon">●</span>
                                </div>
                                
                                <div class="flight-time-item">
                                    <div class="time-dot"></div>
                                    <div class="time-info">
                                        <span class="time">14:35</span>
                                        <span class="airport">London Stansted (STN)</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Protection Badges -->
                        <div class="protection-badges">
                            <div class="protection-badge">
                                <span>🛡️</span>
                                <span>ATOL protected</span>
                            </div>
                            <div class="protection-badge">
                                <span>🔄</span>
                                <span>Flexible Hotel Changes</span>
                            </div>
                        </div>
                        
                        <!-- Pricing -->
                        <div class="pricing-summary">
                            <div class="original-price" style="text-align: right; margin-bottom: 5px;">£3,121</div>
                            
                            <div class="price-row">
                                <span>Per person</span>
                                <span style="font-size: 24px; font-weight: bold;">£1,459</span>
                            </div>
                            <div class="price-row total">
                                <span>Total price</span>
                                <span>£2,918</span>
                            </div>
                        </div>
                        
                        <!-- Secure Today -->
                        <div class="secure-today">
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <span>Secure today for</span>
                                <span class="secure-price">£29 pp</span>
                            </div>
                        </div>
                        
                        <!-- Payment Options -->
                        <div class="payment-options">
                            <select class="payment-dropdown">
                                <option>Payment options</option>
                                <option>Pay in full</option>
                                <option>Pay deposit now</option>
                                <option>Monthly payments</option>
                            </select>
                        </div>
                        
                        <!-- Action Buttons -->
                        <button class="select-btn">Select this holiday</button>
                        <button class="alternative-btn">Alternative flights</button>
                        
                        <!-- Further Charges -->
                        <div class="further-charges">
                            <div class="charges-title">Further charges</div>
                            <div class="charges-text">Your hotel may charge additional fees, which must be paid there.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Calendar functionality
        document.querySelectorAll('.calendar-cell').forEach(cell => {
            if (!cell.classList.contains('other-month') && cell.querySelector('.date-number')) {
                cell.addEventListener('click', function() {
                    // Remove selected class from all cells
                    document.querySelectorAll('.calendar-cell.selected').forEach(c => c.classList.remove('selected'));
                    // Add selected class to clicked cell
                    this.classList.add('selected');
                    
                    // Update selected date display
                    const dateNum = this.querySelector('.date-number').textContent;
                    const selectedDateEl = document.querySelector('.selected-date');
                    selectedDateEl.textContent = `Selected Date: ${getDateName(dateNum)} ${dateNum} Nov 2025`;
                });
            }
        });

        // Helper function to get day name
        function getDateName(day) {
            const date = new Date(2025, 10, day); // November 2025
            const days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
            return days[date.getDay()];
        }

        // Toggle switch functionality
        document.querySelector('.toggle-switch').addEventListener('click', function() {
            this.classList.toggle('active');
        });

        // Tab navigation
        document.querySelectorAll('.tab-item').forEach(tab => {
            tab.addEventListener('click', function() {
                document.querySelectorAll('.tab-item').forEach(t => t.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // Heart icon functionality
        document.querySelector('.heart-icon').addEventListener('click', function() {
            this.innerHTML = this.innerHTML === '♡' ? '❤️' : '♡';
        });

        // Month navigation
        let currentMonth = 10; // November (0-indexed)
        let currentYear = 2025;

        document.querySelectorAll('.nav-btn').forEach((btn, index) => {
            btn.addEventListener('click', function() {
                if (index === 0) { // Previous month
                    currentMonth--;
                    if (currentMonth < 0) {
                        currentMonth = 11;
                        currentYear--;
                    }
                } else { // Next month
                    currentMonth++;
                    if (currentMonth > 11) {
                        currentMonth = 0;
                        currentYear++;
                    }
                }
                
                const months = ['January', 'February', 'March', 'April', 'May', 'June',
                               'July', 'August', 'September', 'October', 'November', 'December'];
                document.querySelector('.month-year').textContent = `${months[currentMonth]} ${currentYear}`;
            });
        });
    </script>