<?php
// alternative_flights.php
// Load flights data from JSON
$jsonFile = 'dummy/flight_data.json';
$flightsData = [];

if (file_exists($jsonFile)) {
    $jsonData = file_get_contents($jsonFile);
    $data = json_decode($jsonData, true);
    if ($data && isset($data['search_results']['flights'])) {
        $flightsData = $data['search_results']['flights'];
    }
}

// Fallback data if JSON not available
if (empty($flightsData)) {
    $flightsData = [
        [
            'id' => 1,
            'outbound' => [
                'date' => '2025-11-30',
                'departure_time' => '12:35',
                'departure_airport' => 'London Stansted (STN)',
                'arrival_time' => '03:50',
                'arrival_airport' => 'Dubai (DXB)',
                'duration' => '11h 15m',
                'stops' => 1,
                'airline' => 'ajet',
                'flight_number' => 'VF1988'
            ],
            'inbound' => [
                'date' => '2025-12-05',
                'departure_time' => '06:00',
                'departure_airport' => 'Dubai (DXB)',
                'arrival_time' => '14:35',
                'arrival_airport' => 'London Stansted (STN)',
                'duration' => '12h 35m',
                'stops' => 1,
                'airline' => 'ajet',
                'flight_number' => 'VF550'
            ],
            'price' => [
                'amount' => 1459,
                'currency' => 'GBP',
                'per_person' => true
            ],
            'package_type' => 'Flights + Hotel'
        ],
        [
            'id' => 2,
            'outbound' => [
                'date' => '2025-11-30',
                'departure_time' => '14:20',
                'departure_airport' => 'Manchester (MAN)',
                'arrival_time' => '05:15',
                'arrival_airport' => 'Dubai (DXB)',
                'duration' => '10h 55m',
                'stops' => 0,
                'airline' => 'Saudia',
                'flight_number' => 'SV122'
            ],
            'inbound' => [
                'date' => '2025-12-05',
                'departure_time' => '08:30',
                'departure_airport' => 'Dubai (DXB)',
                'arrival_time' => '16:45',
                'arrival_airport' => 'Manchester (MAN)',
                'duration' => '11h 15m',
                'stops' => 0,
                'airline' => 'Saudia',
                'flight_number' => 'SV123'
            ],
            'price' => [
                'amount' => 1389,
                'currency' => 'GBP',
                'per_person' => true
            ],
            'package_type' => 'Flights + Hotel'
        ]
    ];
}

// Helper functions
function formatDate($dateString) {
    $date = new DateTime($dateString);
    return $date->format('D j M Y');
}

function formatPrice($amount, $currency = 'GBP') {
    return '£' . number_format($amount);
}

// Helper function to get airline logo URL using airhex.com
function getAirlineLogoUrl($airline) {
    // Map airline names to their airhex logo names
    $logoMap = [
        'ajet' => 'ajet',
        'Saudia' => 'saudia',
        'Eurowings' => 'eurowings',
        'Turkish Airlines' => 'turkish-airlines',
        'Aer Lingus' => 'aer-lingus',
        'Air France' => 'air-france',
        'Air India' => 'air-india',
        'AJet' => 'ajet',
        'British Airways' => 'british-airways',
        'EgyptAir' => 'egyptair',
        'Emirates' => 'emirates',
        'Ethiopian Airlines' => 'ethiopian-airlines',
        'Gulf Air' => 'gulf-air',
        'KLM Royal Dutch Airlines' => 'klm',
        'Lufthansa' => 'lufthansa',
        'Pegasus Airlines' => 'pegasus-airlines',
        'Qatar Airways' => 'qatar-airways',
        'Swiss International Air Lines' => 'swiss',
        'Virgin Atlantic' => 'virgin-atlantic'
    ];
    
    $logoName = isset($logoMap[$airline]) ? $logoMap[$airline] : strtolower(str_replace([' ', '&'], ['-', 'and'], $airline));
    return 'https://airhex.com/images/airline-logos/alt/' . $logoName . '.png';
}

function getStopsText($stops) {
    return $stops == 1 ? '1 stop' : ($stops > 1 ? $stops . ' stops' : 'Direct');
}

// Duration periods for sidebar
$durationPeriods = [
    ['label' => '2 Nights', 'price' => '£999', 'note' => 'pp'],
    ['label' => '3 Nights', 'price' => '£1,289', 'note' => 'pp'],
    ['label' => '4 Nights', 'price' => '£1,259', 'note' => 'pp'],
    ['label' => '5 Nights', 'price' => '£1,459', 'note' => 'pp', 'active' => true],
    ['label' => '6-8 Nights', 'price' => '£1,609', 'note' => 'pp'],
    ['label' => '9-11 Nights', 'price' => '£2,039', 'note' => 'pp'],
    ['label' => '12-15 Nights', 'price' => '£2,539', 'note' => 'pp']
];

// Departure airports for filter
$departureAirports = [
    ['name' => 'Any', 'price' => '', 'checked' => true],
    ['name' => 'Aberdeen', 'price' => '£1,679'],
    ['name' => 'Belfast City', 'price' => '£1,689'],
    ['name' => 'Birmingham', 'price' => '£1,459'],
    ['name' => 'Cardiff', 'price' => '£1,919'],
    ['name' => 'Edinburgh', 'price' => '£1,479'],
    ['name' => 'Glasgow', 'price' => '£1,609'],
    ['name' => 'Humberside', 'price' => '£1,799'],
    ['name' => 'Leeds Bradford', 'price' => '£1,759'],
    ['name' => 'London Gatwick', 'price' => '£1,479'],
    ['name' => 'London Heathrow', 'price' => '£1,489'],
    ['name' => 'London Stansted', 'price' => '£1,459'],
    ['name' => 'Manchester', 'price' => '£1,389'],
    ['name' => 'Newcastle', 'price' => '£1,609'],
    ['name' => 'Norwich', 'price' => '£1,849'],
    ['name' => 'Southampton', 'price' => '£1,789']
];

// Airlines for filter
$airlinesOptions = [
    ['name' => 'Any', 'price' => '', 'checked' => true],
    ['name' => 'Aer Lingus', 'price' => '£1,659', 'logo' => 'aer-lingus'],
    ['name' => 'Air France', 'price' => '£1,589', 'logo' => 'air-france'],
    ['name' => 'Air India', 'price' => '£1,659', 'logo' => 'air-india'],
    ['name' => 'AJet', 'price' => '£1,459', 'logo' => 'ajet'],
    ['name' => 'British Airways', 'price' => '£1,589', 'logo' => 'british-airways'],
    ['name' => 'EgyptAir', 'price' => '£1,459', 'logo' => 'egyptair'],
    ['name' => 'Emirates', 'price' => '£1,509', 'logo' => 'emirates'],
    ['name' => 'Ethiopian Airlines', 'price' => '£1,579', 'logo' => 'ethiopian-airlines'],
    ['name' => 'Gulf Air', 'price' => '£1,569', 'logo' => 'gulf-air'],
    ['name' => 'KLM Royal Dutch Airlines', 'price' => '£1,759', 'logo' => 'klm'],
    ['name' => 'Lufthansa', 'price' => '£1,459', 'logo' => 'lufthansa'],
    ['name' => 'Pegasus Airlines', 'price' => '£1,479', 'logo' => 'pegasus-airlines'],
    ['name' => 'Qatar Airways', 'price' => '£1,809', 'logo' => 'qatar-airways'],
    ['name' => 'Saudia', 'price' => '£1,389', 'logo' => 'saudia'],
    ['name' => 'Swiss International Air Lines', 'price' => '£1,569', 'logo' => 'swiss'],
    ['name' => 'Turkish Airlines', 'price' => '£1,479', 'logo' => 'turkish-airlines'],
    ['name' => 'Virgin Atlantic', 'price' => '£1,469', 'logo' => 'virgin-atlantic']
];

// Stops options
$stopsOptions = [
    ['name' => 'Any', 'price' => '', 'checked' => true],
    ['name' => 'Direct', 'price' => '£1,409'],
    ['name' => '1 stop', 'price' => '£1,459']
];
?>

<style>
/* Alternative Flights Section */
.alternative-flights {
    padding: 30px 0;
    margin-top: 40px;
    border-top: 1px solid #eee;
}

.alternative-flights-inner {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

.alternative-flights-title {
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 30px;
    color: #333;
}

.flights-content {
    display: flex;
    gap: 30px;
}

/* Updated Sidebar Filters */
.sidebar {
    width: 280px;
    flex-shrink: 0;
}

.filter-section {
    background: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
}

.filter-title {
    font-weight: bold;
    margin-bottom: 15px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    cursor: pointer;
}

.filter-title .arrow {
    transition: transform 0.3s;
    width: 16px;
    height: 16px;
    fill: #666;
}

.filter-title.collapsed .arrow {
    transform: rotate(90deg);
}

.filter-content {
    max-height: 500px;
    overflow: hidden;
    transition: max-height 0.3s ease-out;
}

.filter-content.collapsed {
    max-height: 0;
}

/* Filter List */
.filter-list {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

/* Remove scrollbar from filter lists */
.filter-list::-webkit-scrollbar {
    display: none;
}

.filter-item {
    display: flex;
    align-items: center;
    justify-content: space-between;
    cursor: pointer;
    padding: 2px 0;
}

.filter-item:hover {
    color: #ac7872;
}

.filter-item-left {
    display: flex;
    align-items: center;
    gap: 10px;
    flex: 1;
}

.airline-logo-filter {
    width: 44px;
    height: 16px;
    object-fit: contain;
    background: white;
    border-radius: 2px;
}

.filter-checkbox {
    width: 16px;
    height: 16px;
    border: 1px solid #ddd;
    border-radius: 3px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
}

.filter-checkbox.checked {
    background: #ac7872;
    border-color: #ac7872;
    color: white;
}

.filter-checkbox.checked::after {
    content: '✓';
    font-size: 12px;
    font-weight: bold;
}

.filter-label {
    font-size: 14px;
}

.filter-price {
    font-size: 13px;
    color: #666;
}

/* Journey Duration Slider */
.duration-range-container {
    padding: 10px 0;
}

.duration-range-labels {
    margin-bottom: 15px;
    font-size: 14px;
    font-weight: 500;
    color: #333;
}

.duration-slider {
    position: relative;
    height: 20px;
    margin: 0 10px;
}

.slider-track {
    position: absolute;
    top: 50%;
    left: 0;
    right: 0;
    height: 4px;
    background: #e0e0e0;
    border-radius: 2px;
    transform: translateY(-50%);
}

.slider-range {
    position: absolute;
    top: 50%;
    left: 0;
    width: 100%;
    height: 4px;
    background: #333;
    border-radius: 2px;
    transform: translateY(-50%);
}

.slider-thumb {
    position: absolute;
    top: 50%;
    width: 16px;
    height: 16px;
    background: #333;
    border: 2px solid white;
    border-radius: 50%;
    cursor: pointer;
    transform: translateY(-50%);
    box-shadow: 0 2px 4px rgba(0,0,0,0.2);
}

.slider-thumb-left {
    left: -8px;
}

.slider-thumb-right {
    right: -8px;
}

.slider-thumb:hover {
    transform: translateY(-50%) scale(1.1);
}

/* Icons */
.info-icon, .moon-icon {
    flex-shrink: 0;
}

/* Flights List */
.flights-list {
    flex: 1;
}

.flights-list-header {
    display: flex;
    justify-content: flex-end;
    margin-bottom: 20px;
}

/* Duration Pills - moved to top right */
.duration-pills {
    display: flex;
    flex-wrap: nowrap;
    gap: 8px;
    justify-content: flex-end;
    background: white;
    padding: 15px 20px 0px;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    overflow-x: auto;
}

.duration-pill {
    padding: 10px 14px;
    /* border: 1px solid #ddd; */
    /* border-radius: 20px; */
    text-align: center;
    cursor: pointer;
    transition: all 0.3s;
    min-width: 90px;
    background: white;
    flex-shrink: 0;
}

.duration-pill.active {
    /* background: #ac7872; */
    /* color: white; */
    /* border-color: #ac7872; */
    border-bottom: 5px solid #ac7872;
}

.duration-pill:hover:not(.active) {
    /* border-color: #ac7872; */
}

.duration-pill-label {
    font-size: 13px;
    font-weight: bold;
    display: block;
    /* margin-bottom: 2px; */
}

.duration-pill-price {
    font-size: 11px;
}

.flight-card {
    border: 1px solid #ddd;
    border-radius: 12px;
    margin-bottom: 15px;
    overflow: hidden;
    background: white;
    transition: box-shadow 0.3s;
    display: flex;
    min-height: 120px;
}

.flight-card:hover {
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

/* Flight Details Section (Left Column) */
.flight-details-section {
    flex: 1;
    padding: 20px;
    display: flex;
    flex-direction: column;
    gap: 0;
}

.flight-row {
    display: flex;
    align-items: center;
    gap: 20px;
    padding: 15px 0;
    border-bottom: 1px solid #f0f0f0;
}

.flight-row:last-child {
    border-bottom: none;
}

.flight-date-info {
    display: flex;
    align-items: center;
    gap: 12px;
    min-width: 140px;
}

.flight-icon {
    font-size: 16px;
    width: 20px;
}

.flight-date-text {
    display: flex;
    flex-direction: column;
}

.flight-date-main {
    font-weight: bold;
    font-size: 14px;
    color: #333;
}

.flight-direction {
    font-size: 12px;
    color: #666;
}

.flight-times {
    display: flex;
    align-items: flex-start;
    gap: 20px;
    flex: 1;
}

.flight-time-group {
    display: flex;
    flex-direction: column;
    position: relative;
    min-width: 250px;
}

.flight-time-row {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 8px;
}

.flight-time-row:last-child {
    margin-bottom: 0;
}

.flight-dot {
    width: 6px;
    height: 6px;
    background-color: #666;
    border-radius: 50%;
    flex-shrink: 0;
    position: relative;
    z-index: 2;
}

.flight-connecting-line {
    position: absolute;
    left: 2.5px;
    top: 12px;
    width: 1px;
    height: 25px;
    background-color: #ddd;
    z-index: 1;
}

.flight-time {
    font-weight: bold;
    font-size: 16px;
    color: #333;
    min-width: 60px;
}

.flight-airport {
    color: #666;
    font-size: 14px;
    flex: 1;
}

.flight-duration-info {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-left: 14px;
    margin-bottom: 8px;
}

.flight-duration-badges {
    display: flex;
    gap: 5px;
}

.duration-badge {
    background-color: #f0f0f0;
    color: #666;
    padding: 2px 6px;
    border-radius: 12px;
    font-size: 11px;
    display: flex;
    align-items: center;
    gap: 3px;
}

.airline-section {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 5px;
    min-width: 70px;
}

.airline-logo {
    width: 60px;
    height: 24px;
    object-fit: contain;
    background: white;
}

.flight-number {
    font-size: 11px;
    color: #666;
    text-align: center;
}

/* Pricing Section (Right Column) */
.flight-pricing-section {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: flex-end;
    padding: 20px;
    min-width: 160px;
    text-align: right;
    border-left: 1px solid #f0f0f0;
}

.flight-price {
    font-size: 32px;
    font-weight: bold;
    color: #333;
    line-height: 1;
}

.flight-price-note {
    font-size: 16px;
    color: #666;
    margin-bottom: 15px;
}

.flight-select-btn {
    background: #153b3c;
    color: white;
    border: none;
    padding: 12px 20px;
    border-radius: 6px;
    font-weight: bold;
    cursor: pointer;
    transition: background 0.3s;
    font-size: 14px;
}

.flight-select-btn:hover {
    background: #0f2b2c;
}

/* Pagination */
.pagination-container {
    display: flex;
    justify-content: flex-start;
    margin-top: 30px;
}

.pagination {
    display: flex;
    align-items: center;
    gap: 8px;
}

.pagination-btn {
    width: 36px;
    height: 36px;
    border: 1px solid #ddd;
    background: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    font-size: 14px;
    font-weight: 500;
    transition: all 0.3s;
    text-decoration: none;
    color: #666;
}

.pagination-btn:hover {
    border-color: #ac7872;
    color: #ac7872;
}

.pagination-btn.active {
    background: #333;
    color: white;
    border-color: #333;
}

.pagination-btn:disabled {
    opacity: 0.5;
    cursor: not-allowed;
}

.pagination-dots {
    padding: 0 5px;
    color: #666;
}

@media (max-width: 768px) {
    .flights-content {
        flex-direction: column;
    }
    
    .sidebar {
        width: 100%;
    }
    
    .duration-pills {
        justify-content: center;
        overflow-x: scroll;
    }
    
    .flight-card {
        flex-direction: column;
        min-height: auto;
    }
    
    .flight-row {
        flex-direction: column;
        gap: 10px;
        align-items: flex-start;
    }
    
    .flight-times {
        width: 100%;
    }
    
    .flight-pricing-section {
        align-items: center;
        border-top: 1px solid #eee;
        border-left: none;
        padding-top: 15px;
    }
    
    .pagination-container {
        justify-content: flex-start;
    }
}
</style>

<!-- Alternative Flights Section -->
<div class="alternative-flights">
    <div class="alternative-flights-inner">
        <h2 class="alternative-flights-title">Alternative flights</h2>
        
        <div class="flights-content">
            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Stops Filter -->
                <div class="filter-section">
                    <div class="filter-title" onclick="toggleFilter(this)">
                        <span>Stops</span>
                        <svg class="arrow" viewBox="0 0 24 24">
                            <path d="M8 10l4 4 4-4z"/>
                        </svg>
                    </div>
                    <div class="filter-content">
                        <div class="filter-list">
                            <?php foreach ($stopsOptions as $stop): ?>
                                <div class="filter-item" onclick="toggleFilterCheckbox(this)">
                                    <div class="filter-item-left">
                                        <div class="filter-checkbox <?php echo isset($stop['checked']) ? 'checked' : ''; ?>"></div>
                                        <span class="filter-label"><?php echo htmlspecialchars($stop['name']); ?></span>
                                    </div>
                                    <?php if (!empty($stop['price'])): ?>
                                        <span class="filter-price"><?php echo htmlspecialchars($stop['price']); ?></span>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

                <!-- Departure From Filter -->
                <div class="filter-section">
                    <div class="filter-title" onclick="toggleFilter(this)">
                        <span>Departure from</span>
                        <svg class="arrow" viewBox="0 0 24 24">
                            <path d="M8 10l4 4 4-4z"/>
                        </svg>
                    </div>
                    <div class="filter-content">
                        <div class="filter-list">
                            <?php foreach ($departureAirports as $airport): ?>
                                <div class="filter-item" onclick="toggleFilterCheckbox(this)">
                                    <div class="filter-item-left">
                                        <div class="filter-checkbox <?php echo isset($airport['checked']) ? 'checked' : ''; ?>"></div>
                                        <span class="filter-label"><?php echo htmlspecialchars($airport['name']); ?></span>
                                    </div>
                                    <?php if (!empty($airport['price'])): ?>
                                        <span class="filter-price"><?php echo htmlspecialchars($airport['price']); ?></span>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

                <!-- Airlines Filter -->
                <div class="filter-section">
                    <div class="filter-title" onclick="toggleFilter(this)">
                        <span>Airlines</span>
                        <svg class="arrow" viewBox="0 0 24 24">
                            <path d="M8 10l4 4 4-4z"/>
                        </svg>
                    </div>
                    <div class="filter-content">
                        <div class="filter-list">
                            <?php foreach ($airlinesOptions as $airline): ?>
                                <div class="filter-item" onclick="toggleFilterCheckbox(this)">
                                    <div class="filter-item-left">
                                        <div class="filter-checkbox <?php echo isset($airline['checked']) ? 'checked' : ''; ?>"></div>
                                        <?php if (isset($airline['logo']) && $airline['name'] !== 'Any'): ?>
                                            <img src="https://airhex.com/images/airline-logos/alt/<?php echo $airline['logo']; ?>.png" 
                                                 alt="<?php echo htmlspecialchars($airline['name']); ?>" 
                                                 class="airline-logo-filter"
                                                 onerror="this.style.display='none'">
                                        <?php endif; ?>
                                        <span class="filter-label"><?php echo htmlspecialchars($airline['name']); ?></span>
                                    </div>
                                    <?php if (!empty($airline['price'])): ?>
                                        <span class="filter-price"><?php echo htmlspecialchars($airline['price']); ?></span>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

                <!-- Outbound Times Filter -->
<div class="filter-section">
    <div class="filter-title" onclick="toggleFilter(this)">
        <span>Outbound times</span>
        <svg class="arrow" viewBox="0 0 24 24">
            <path d="M8 10l4 4 4-4z"/>
        </svg>
    </div>
    <div class="filter-content">
        <div class="filter-list">
            <div class="filter-item" onclick="toggleFilterCheckbox(this)">
                <div class="filter-item-left">
                    <div class="filter-checkbox checked"></div>
                    <span class="filter-label">Any</span>
                </div>
            </div>
            <div class="filter-item" onclick="toggleFilterCheckbox(this)">
                <div class="filter-item-left">
                    <div class="filter-checkbox"></div>
                    <div style="display: flex; flex-direction: column;">
                        <span class="filter-label">Early Morning</span>
                        <span style="font-size: 11px; color: #999;">00:00-06:59</span>
                    </div>
                </div>
            </div>
            <div class="filter-item" onclick="toggleFilterCheckbox(this)">
                <div class="filter-item-left">
                    <div class="filter-checkbox"></div>
                    <div style="display: flex; flex-direction: column;">
                        <span class="filter-label">Morning</span>
                        <span style="font-size: 11px; color: #999;">07:00-11:59</span>
                    </div>
                </div>
                <span class="filter-price">£1,479</span>
            </div>
            <div class="filter-item" onclick="toggleFilterCheckbox(this)">
                <div class="filter-item-left">
                    <div class="filter-checkbox"></div>
                    <div style="display: flex; flex-direction: column;">
                        <span class="filter-label">Afternoon</span>
                        <span style="font-size: 11px; color: #999;">12:00-16:59</span>
                    </div>
                </div>
                <span class="filter-price">£1,459</span>
            </div>
            <div class="filter-item" onclick="toggleFilterCheckbox(this)">
                <div class="filter-item-left">
                    <div class="filter-checkbox"></div>
                    <div style="display: flex; flex-direction: column;">
                        <span class="filter-label">Evening</span>
                        <span style="font-size: 11px; color: #999;">17:00-20:59</span>
                    </div>
                </div>
                <span class="filter-price">£1,409</span>
            </div>
            <div class="filter-item" onclick="toggleFilterCheckbox(this)">
                <div class="filter-item-left">
                    <div class="filter-checkbox"></div>
                    <div style="display: flex; flex-direction: column;">
                        <span class="filter-label">Night time</span>
                        <span style="font-size: 11px; color: #999;">21:00-23:59</span>
                    </div>
                </div>
                <span class="filter-price">£1,469</span>
            </div>
        </div>
    </div>
</div>

<!-- Inbound Times Filter -->
<div class="filter-section">
    <div class="filter-title" onclick="toggleFilter(this)">
        <span>Inbound times</span>
        <svg class="arrow" viewBox="0 0 24 24">
            <path d="M8 10l4 4 4-4z"/>
        </svg>
    </div>
    <div class="filter-content">
        <div class="filter-list">
            <div class="filter-item" onclick="toggleFilterCheckbox(this)">
                <div class="filter-item-left">
                    <div class="filter-checkbox checked"></div>
                    <span class="filter-label">Any</span>
                </div>
            </div>
            <div class="filter-item" onclick="toggleFilterCheckbox(this)">
                <div class="filter-item-left">
                    <div class="filter-checkbox"></div>
                    <div style="display: flex; flex-direction: column;">
                        <span class="filter-label">Early Morning</span>
                        <span style="font-size: 11px; color: #999;">00:00-06:59</span>
                    </div>
                </div>
                <span class="filter-price">£1,459</span>
            </div>
            <div class="filter-item" onclick="toggleFilterCheckbox(this)">
                <div class="filter-item-left">
                    <div class="filter-checkbox"></div>
                    <div style="display: flex; flex-direction: column;">
                        <span class="filter-label">Morning</span>
                        <span style="font-size: 11px; color: #999;">07:00-11:59</span>
                    </div>
                </div>
                <span class="filter-price">£1,479</span>
            </div>
            <div class="filter-item" onclick="toggleFilterCheckbox(this)">
                <div class="filter-item-left">
                    <div class="filter-checkbox"></div>
                    <div style="display: flex; flex-direction: column;">
                        <span class="filter-label">Afternoon</span>
                        <span style="font-size: 11px; color: #999;">12:00-16:59</span>
                    </div>
                </div>
                <span class="filter-price">£1,479</span>
            </div>
            <div class="filter-item" onclick="toggleFilterCheckbox(this)">
                <div class="filter-item-left">
                    <div class="filter-checkbox"></div>
                    <div style="display: flex; flex-direction: column;">
                        <span class="filter-label">Evening</span>
                        <span style="font-size: 11px; color: #999;">17:00-20:59</span>
                    </div>
                </div>
                <span class="filter-price">£1,579</span>
            </div>
            <div class="filter-item" onclick="toggleFilterCheckbox(this)">
                <div class="filter-item-left">
                    <div class="filter-checkbox"></div>
                    <div style="display: flex; flex-direction: column;">
                        <span class="filter-label">Night time</span>
                        <span style="font-size: 11px; color: #999;">21:00-23:59</span>
                    </div>
                </div>
                <span class="filter-price">£1,529</span>
            </div>
        </div>
    </div>
</div>

<!-- Journey Duration Filter -->
<div class="filter-section">
    <div class="filter-title" onclick="toggleFilter(this)">
        <span>Journey duration</span>
        <svg class="info-icon" viewBox="0 0 24 24" style="width: 16px; height: 16px; fill: #666; margin-left: 5px;">
            <path d="M12,2C6.48,2 2,6.48 2,12C2,17.52 6.48,22 12,22C17.52,22 22,17.52 22,12C22,6.48 17.52,2 12,2ZM13,17H11V11H13V17ZM13,9H11V7H13V9Z"/>
        </svg>
        <svg class="arrow" viewBox="0 0 24 24" style="margin-left: auto;">
            <path d="M8 10l4 4 4-4z"/>
        </svg>
    </div>
    <div class="filter-content">
        <div class="duration-range-container">
            <div class="duration-range-labels">
                <span>7.5 hours - 13.5 hours</span>
            </div>
            <div class="duration-slider">
                <div class="slider-track"></div>
                <div class="slider-range"></div>
                <div class="slider-thumb slider-thumb-left"></div>
                <div class="slider-thumb slider-thumb-right"></div>
            </div>
        </div>
    </div>
</div>

<!-- Red Eye Flights Filter -->
<div class="filter-section">
    <div class="filter-title" onclick="toggleFilter(this)">
        <span>Red eye flights</span>
        <svg class="moon-icon" viewBox="0 0 24 24" style="width: 16px; height: 16px; fill: #666; margin-left: 5px;">
            <path d="M17.75,4.09L15.22,6.03L16.13,9.09L13.5,7.28L10.87,9.09L11.78,6.03L9.25,4.09L12.44,4L13.5,1L14.56,4L17.75,4.09M21.25,11L19.61,12.25L20.2,14.23L18.5,13.06L16.8,14.23L17.39,12.25L15.75,11L17.81,10.95L18.5,9L19.19,10.95L21.25,11M12.97,15.91L10.44,17.85L11.35,20.91L8.72,19.1L6.09,20.91L7,17.85L4.47,15.91L7.66,15.82L8.72,12.82L9.78,15.82L12.97,15.91Z"/>
        </svg>
        <svg class="arrow" viewBox="0 0 24 24" style="margin-left: auto;">
            <path d="M8 10l4 4 4-4z"/>
        </svg>
    </div>
    <div class="filter-content">
        <div class="filter-list">
            <div class="filter-item" onclick="toggleRedEyeFilter(this)">
                <div class="filter-item-left">
                    <div class="filter-checkbox"></div>
                    <span class="filter-label">Hide red-eye flights</span>
                </div>
                <span class="filter-price">£1,569</span>
            </div>
        </div>
    </div>
</div>
            </div>

            <!-- Flights List -->
            <div class="flights-list">
                <!-- Duration Pills - moved to top right -->
                <div class="flights-list-header">
                    <div class="duration-pills">
                        <?php foreach ($durationPeriods as $period): ?>
                            <div class="duration-pill <?php echo isset($period['active']) ? 'active' : ''; ?>">
                                <span class="duration-pill-label"><?php echo htmlspecialchars($period['label']); ?></span>
                                <span class="duration-pill-price">from <?php echo htmlspecialchars($period['price']); ?> <?php echo htmlspecialchars($period['note']); ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <?php foreach ($flightsData as $flight): ?>
                    <div class="flight-card">
                        <!-- Flight Details Section (Left Column) -->
                        <div class="flight-details-section">
                            <!-- Outbound Flight Row -->
                            <div class="flight-row">
                                <div class="flight-date-info">
                                    <span class="flight-icon">✈️</span>
                                    <div class="flight-date-text">
                                        <div class="flight-date-main"><?php echo formatDate($flight['outbound']['date']); ?></div>
                                        <div class="flight-direction">Outbound</div>
                                    </div>
                                </div>
                                
                                <div class="flight-times">
                                    <div class="flight-time-group">
                                        <div class="flight-time-row">
                                            <div class="flight-dot"></div>
                                            <div class="flight-time"><?php echo htmlspecialchars($flight['outbound']['departure_time']); ?></div>
                                            <div class="flight-airport"><?php echo htmlspecialchars($flight['outbound']['departure_airport']); ?></div>
                                        </div>
                                        <div class="flight-connecting-line"></div>
                                        <div class="flight-duration-info">
                                            <div class="flight-duration-badges">
                                                <div class="duration-badge">
                                                    ⏱️ <?php echo htmlspecialchars($flight['outbound']['duration']); ?>
                                                </div>
                                                <div class="duration-badge">
                                                    <?php echo getStopsText($flight['outbound']['stops']); ?> ●
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flight-time-row">
                                            <div class="flight-dot"></div>
                                            <div class="flight-time"><?php echo htmlspecialchars($flight['outbound']['arrival_time']); ?><?php echo (strpos($flight['outbound']['arrival_time'], '+') === false && $flight['outbound']['arrival_time'] < $flight['outbound']['departure_time']) ? '+1' : ''; ?></div>
                                            <div class="flight-airport"><?php echo htmlspecialchars($flight['outbound']['arrival_airport']); ?></div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="airline-section">
                                    <img src="<?php echo getAirlineLogoUrl($flight['outbound']['airline']); ?>" alt="<?php echo htmlspecialchars($flight['outbound']['airline']); ?>" class="airline-logo">
                                    <div class="flight-number"><?php echo htmlspecialchars($flight['outbound']['flight_number']); ?></div>
                                </div>
                            </div>

                            <!-- Inbound Flight Row -->
                            <div class="flight-row">
                                <div class="flight-date-info">
                                    <span class="flight-icon">🛬</span>
                                    <div class="flight-date-text">
                                        <div class="flight-date-main"><?php echo formatDate($flight['inbound']['date']); ?></div>
                                        <div class="flight-direction">Inbound</div>
                                    </div>
                                </div>
                                
                                <div class="flight-times">
                                    <div class="flight-time-group">
                                        <div class="flight-time-row">
                                            <div class="flight-dot"></div>
                                            <div class="flight-time"><?php echo htmlspecialchars($flight['inbound']['departure_time']); ?></div>
                                            <div class="flight-airport"><?php echo htmlspecialchars($flight['inbound']['departure_airport']); ?></div>
                                        </div>
                                        <div class="flight-connecting-line"></div>
                                        <div class="flight-duration-info">
                                            <div class="flight-duration-badges">
                                                <div class="duration-badge">
                                                    ⏱️ <?php echo htmlspecialchars($flight['inbound']['duration']); ?>
                                                </div>
                                                <div class="duration-badge">
                                                    <?php echo getStopsText($flight['inbound']['stops']); ?> ●
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flight-time-row">
                                            <div class="flight-dot"></div>
                                            <div class="flight-time"><?php echo htmlspecialchars($flight['inbound']['arrival_time']); ?></div>
                                            <div class="flight-airport"><?php echo htmlspecialchars($flight['inbound']['arrival_airport']); ?></div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="airline-section">
                                    <img src="<?php echo getAirlineLogoUrl($flight['inbound']['airline']); ?>" alt="<?php echo htmlspecialchars($flight['inbound']['airline']); ?>" class="airline-logo">
                                    <div class="flight-number"><?php echo htmlspecialchars($flight['inbound']['flight_number']); ?></div>
                                </div>
                            </div>
                        </div>

                        <!-- Pricing Section (Right Column) -->
                        <div class="flight-pricing-section">
                            <div class="flight-price"><?php echo formatPrice($flight['price']['amount']); ?></div>
                            <div class="flight-price-note">pp</div>
                            <button class="flight-select-btn">Flights + Hotel</button>
                        </div>
                    </div>
                <?php endforeach; ?>

                <!-- Pagination -->
                <div class="pagination-container">
                    <div class="pagination">
                        <button class="pagination-btn" disabled>‹</button>
                        <button class="pagination-btn active">1</button>
                        <button class="pagination-btn">2</button>
                        <button class="pagination-btn">3</button>
                        <button class="pagination-btn">4</button>
                        <button class="pagination-btn">5</button>
                        <span class="pagination-dots">...</span>
                        <button class="pagination-btn">27</button>
                        <button class="pagination-btn">›</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Filter functionality
function toggleFilter(titleElement) {
    const filterContent = titleElement.nextElementSibling;
    const arrow = titleElement.querySelector('.arrow');
    
    titleElement.classList.toggle('collapsed');
    filterContent.classList.toggle('collapsed');
}

// Red eye filter functionality
function toggleRedEyeFilter(filterItem) {
    const checkbox = filterItem.querySelector('.filter-checkbox');
    checkbox.classList.toggle('checked');
}

function toggleFilterCheckbox(filterItem) {
    const checkbox = filterItem.querySelector('.filter-checkbox');
    
    // For single-select filters (like "Any"), uncheck others in the same group
    const parentSection = filterItem.closest('.filter-section');
    const isAnyOption = filterItem.querySelector('.filter-label').textContent === 'Any';
    
    if (isAnyOption) {
        // If clicking "Any", uncheck all others in this section
        parentSection.querySelectorAll('.filter-checkbox').forEach(cb => {
            cb.classList.remove('checked');
        });
        checkbox.classList.add('checked');
    } else {
        // If clicking a specific option, uncheck "Any" and toggle this one
        const anyCheckbox = parentSection.querySelector('.filter-item .filter-checkbox');
        if (anyCheckbox) {
            anyCheckbox.classList.remove('checked');
        }
        checkbox.classList.toggle('checked');
    }
}

// Duration pills functionality
document.addEventListener('DOMContentLoaded', function() {
    // Duration pills click handler
    document.querySelectorAll('.duration-pill').forEach(pill => {
        pill.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            // Remove active class from all pills
            document.querySelectorAll('.duration-pill').forEach(p => p.classList.remove('active'));
            
            // Add active class to clicked pill
            this.classList.add('active');
        });
    });

    // Pagination functionality
    document.querySelectorAll('.pagination-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            // Only proceed if button is not disabled and not navigation arrows
            if (!this.disabled && !this.textContent.includes('‹') && !this.textContent.includes('›')) {
                // Remove active class from all pagination buttons
                document.querySelectorAll('.pagination-btn').forEach(b => b.classList.remove('active'));
                
                // Add active class to clicked button
                this.classList.add('active');
            }
            
            // Handle navigation arrows
            if (this.textContent.includes('›')) {
                // Next page logic
                const currentActive = document.querySelector('.pagination-btn.active');
                const nextBtn = currentActive.nextElementSibling;
                if (nextBtn && nextBtn.classList.contains('pagination-btn') && !nextBtn.textContent.includes('›')) {
                    currentActive.classList.remove('active');
                    nextBtn.classList.add('active');
                }
            }
            
            if (this.textContent.includes('‹')) {
                // Previous page logic
                const currentActive = document.querySelector('.pagination-btn.active');
                const prevBtn = currentActive.previousElementSibling;
                if (prevBtn && prevBtn.classList.contains('pagination-btn') && !prevBtn.textContent.includes('‹')) {
                    currentActive.classList.remove('active');
                    prevBtn.classList.add('active');
                }
            }
        });
    });
});
</script>