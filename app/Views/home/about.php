<?= $this->extend("layouts/base"); ?>
<?= $this->section("title"); ?>
<?= $title; ?>
<?= $this->endSection(); ?>
<?= $this->section("content"); ?>
<h1>THIS IS ABOUT PAGE.</h1>
<style type="text/css">
    body {
        font-family: sans-serif;
        font-size: 13px;
    }

    h1 {
        font-size: 20px;
    }

    h2 {
        font-size: 16px;
        margin: 50px 0 8px 0;
    }

    h3 {
        font-size: 14px;
    }
</style>

<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Form Advanced</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                        <li class="breadcrumb-item active">Form Advanced</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Select2</h4>
                    <p class="card-title-desc">A mobile and touch friendly input spinner component for Bootstrap</p>
                    <form>
                        <select id="myselect">
                            <option value="1">Aachener Stra&#223;e</option>
                            <option value="2">Abbestra&#223;e</option>
                            <option value="3">Adalbertstra&#223;e</option>
                            <option value="4">Adam-von-Trott-Stra&#223;e</option>
                            <option value="5">Adenauerplatz</option>
                            <option value="6">Admiralstra&#223;e</option>
                            <option value="7">Agathe-Lasch-Platz</option>
                            <option value="8">Ahornallee</option>
                            <option value="9">Ahrensfelder Chaussee</option>
                            <option value="10">Ahrenshooper Stra&#223;e</option>
                            <option value="11">Ahrweilerstra&#223;e</option>
                            <option value="12">Akazienallee</option>
                            <option value="13">Albrecht-Achilles-Stra&#223;e</option>
                            <option value="14">Alemannenallee</option>
                            <option value="15">Alexandrinenstra&#223;e</option>
                            <option value="16">Alfred-D&#246;blin-Platz</option>
                            <option value="17">Allendorfer Weg</option>
                            <option value="18">Alte Allee</option>
                            <option value="19">Alte Brauerei</option>
                            <option value="20">Alte Jakobstra&#223;e</option>
                            <option value="21">Altenburger Allee</option>
                            <option value="22">Altenhofer Stra&#223;e</option>
                            <option value="23">Alt-Lietzow</option>
                            <option value="24">Alt-Stralau</option>
                            <option value="25">Am Bahnhof Grunewald</option>
                            <option value="26">Am Bahnhof Jungfernheide</option>
                            <option value="27">Am Bahnhof Westend</option>
                            <option value="28">Am Berl</option>
                            <option value="29">Am Breiten Luch</option>
                            <option value="30">Am Comeniusplatz</option>
                            <option value="31">Am Containerbahnhof</option>
                            <option value="32">Am D&#246;rferweg</option>
                            <option value="33">Am Dornbusch</option>
                            <option value="34">Am Faulen See</option>
                            <option value="35">Am Fliederbusch</option>
                            <option value="36">Am Glockenturm</option>
                            <option value="37">Am G&#252;terbahnhof Halensee</option>
                            <option value="38">Am Gutshof</option>
                            <option value="39">Am Hain</option>
                            <option value="40">Am Heidebusch</option>
                            <option value="41">Am Johannistisch</option>
                            <option value="42">Am Oberbaum</option>
                            <option value="43">Am Ostbahnhof</option>
                            <option value="44">Am Postbahnhof</option>
                            <option value="45">Am Postfenn</option>
                            <option value="46">Am Postfenn</option>
                            <option value="47">Am Rudolfplatz</option>
                            <option value="48">Am Rupenhorn</option>
                            <option value="49">Am Schillertheater</option>
                            <option value="50">Am Speicher</option>
                            <option value="51">Am Spreebord</option>
                            <option value="52">Am Tempelhofer Berg</option>
                            <option value="53">Am Vogelherd</option>
                            <option value="54">Am Volkspark</option>
                            <option value="55">Am Weinhang</option>
                            <option value="56">Am Westkreuz</option>
                            <option value="57">Am Wriezener Bahnhof</option>
                            <option value="58">Amselstra&#223;e</option>
                            <option value="59">Amtsgerichtsplatz</option>
                            <option value="60">An der Barthschen Promenade</option>
                            <option value="61">An der Brauerei</option>
                            <option value="62">An der Flie&#223;wiese</option>
                            <option value="63">An der Margaretenh&#246;he</option>
                            <option value="64">An der Michaelbr&#252;cke</option>
                            <option value="65">An der Ostbahn</option>
                            <option value="66">An der Schillingbr&#252;cke</option>
                            <option value="67">Andreasplatz</option>
                            <option value="68">Andreasstra&#223;e</option>
                            <option value="69">Angerburger Allee</option>
                            <option value="70">Anhalter Stra&#223;e</option>
                            <option value="71">Anna-Ebermann-Stra&#223;e</option>
                            <option value="72">Annemariestra&#223;e</option>
                            <option value="73">Arcostra&#223;e</option>
                            <option value="74">Arendsweg</option>
                            <option value="75">Arndtstra&#223;e</option>
                            <option value="76">Arnimstra&#223;e</option>
                            <option value="77">Arysallee</option>
                            <option value="78">Aschaffenburger Stra&#223;e</option>
                            <option value="79">Askanischer Platz</option>
                            <option value="80">A&#223;mannshauser Stra&#223;e</option>
                            <option value="81">Astridstra&#223;e</option>
                            <option value="82">Auerbacher Stra&#223;e</option>
                            <option value="83">Auerstra&#223;e</option>
                            <option value="84">Augsburger Stra&#223;e</option>
                            <option value="85">Augsburger Stra&#223;e</option>
                            <option value="86">Augustastra&#223;e</option>
                            <option value="87">Auguste-Viktoria-Stra&#223;e</option>
                            <option value="88">Avus</option>
                            <option value="89">Avus</option>
                            <option value="90">Axel-Springer-Stra&#223;e</option>
                            <option value="91">Babelsberger Stra&#223;e</option>
                            <option value="92">Badenallee</option>
                            <option value="93">Badensche Stra&#223;e</option>
                            <option value="94">Baerwaldstra&#223;e</option>
                            <option value="95">Bahnhofstra&#223;e</option>
                            <option value="96">Bahrfeldtstra&#223;e</option>
                            <option value="97">Ballenstedter Stra&#223;e</option>
                            <option value="98">Bamberger Stra&#223;e</option>
                            <option value="99">B&#228;nschstra&#223;e</option>
                            <option value="100">Barbarossastra&#223;e</option>
                            <option value="101">Barnimstra&#223;e</option>
                            <option value="102">Barstra&#223;e</option>
                            <option value="103">Barther Stra&#223;e</option>
                            <option value="104">Baruther Stra&#223;e</option>
                            <option value="105">Bayerische Stra&#223;e</option>
                            <option value="106">Bayernallee</option>
                            <option value="107">Bechstedter Weg</option>
                            <option value="108">Behaimstra&#223;e</option>
                            <option value="109">Bennostra&#223;e</option>
                            <option value="110">Bergfriedstra&#223;e</option>
                            <option value="111">Bergheimer Platz</option>
                            <option value="112">Bergheimer Stra&#223;e</option>
                            <option value="113">Bergmannstra&#223;e</option>
                            <option value="114">Berkaer Platz</option>
                            <option value="115">Berkaer Stra&#223;e</option>
                            <option value="116">Berkenbr&#252;cker Steig</option>
                            <option value="117">Berliner Stra&#223;e</option>
                            <option value="118">Bernadottestra&#223;e</option>
                            <option value="119">Bernburger Stra&#223;e</option>
                            <option value="120">Bernhardstra&#223;e</option>
                            <option value="121">Bernhard-Wieck-Promenade</option>
                            <option value="122">Bersarinplatz</option>
                            <option value="123">Bertastra&#223;e</option>
                            <option value="124">Besselstra&#223;e</option>
                            <option value="125">Bethaniendamm</option>
                            <option value="126">Bettinastra&#223;e</option>
                            <option value="127">Betty-Hirsch-Platz</option>
                            <option value="128">Bevernstra&#223;e</option>
                            <option value="129">Beverstedter Weg</option>
                            <option value="130">Bibersteig</option>
                            <option value="131">Biedermannweg</option>
                            <option value="132">Bielefelder Stra&#223;e</option>
                            <option value="133">Biesenbrower Stra&#223;e</option>
                            <option value="134">Biesenthaler Stra&#223;e</option>
                            <option value="135">Biesterfelder Stra&#223;e</option>
                            <option value="136">Bilsestra&#223;e</option>
                            <option value="137">Binger Stra&#223;e</option>
                            <option value="138">Birger-Forell-Platz</option>
                            <option value="139">Birkholzer Weg</option>
                            <option value="140">Bismarckallee</option>
                            <option value="141">Bismarckplatz</option>
                            <option value="142">Bismarckstra&#223;e</option>
                            <option value="143">Bitburger Stra&#223;e</option>
                            <option value="144">Blankenburger Pflasterweg</option>
                            <option value="145">Bl&#228;ulingsweg</option>
                            <option value="146">Bleibtreustra&#223;e</option>
                            <option value="147">Blissestra&#223;e</option>
                            <option value="148">Bl&#252;cherplatz</option>
                            <option value="149">Bl&#252;cherstra&#223;e</option>
                            <option value="150">Bl&#252;thgenstra&#223;e</option>
                            <option value="151">B&#246;ckhstra&#223;e</option>
                            <option value="152">B&#246;cklerstra&#223;e</option>
                            <option value="153">B&#246;cklinstra&#223;e</option>
                            <option value="154">B&#246;dikerstra&#223;e</option>
                            <option value="155">Bolivarallee</option>
                            <option value="156">Bonhoefferufer</option>
                            <option value="157">Bonner Stra&#223;e</option>
                            <option value="158">Bootsbauerstra&#223;e</option>
                            <option value="159">Boppstra&#223;e</option>
                            <option value="160">Borkumer Stra&#223;e</option>
                            <option value="161">Borner Stra&#223;e</option>
                            <option value="162">Bornimer Stra&#223;e</option>
                            <option value="163">Bornstedter Stra&#223;e</option>
                            <option value="164">Bossestra&#223;e</option>
                            <option value="165">Boxhagener Platz</option>
                            <option value="166">Boxhagener Stra&#223;e</option>
                            <option value="167">Boyenallee</option>
                            <option value="168">Brabanter Platz</option>
                            <option value="169">Brabanter Stra&#223;e</option>
                            <option value="170">Brachvogelstra&#223;e</option>
                            <option value="171">Brahestra&#223;e</option>
                            <option value="172">Brahmsstra&#223;e</option>
                            <option value="173">Brandenburgische Stra&#223;e</option>
                            <option value="174">Brandesstra&#223;e</option>
                            <option value="175">Branitzer Platz</option>
                            <option value="176">Brauhofstra&#223;e</option>
                            <option value="177">Bredtschneiderstra&#223;e</option>
                            <option value="178">Bregenzer Stra&#223;e</option>
                            <option value="179">Breite Stra&#223;e</option>
                            <option value="180">Breitenbachplatz</option>
                            <option value="181">Breitscheidplatz</option>
                            <option value="182">Brienner Stra&#223;e</option>
                            <option value="183">Brixplatz</option>
                            <option value="184">Brombeerweg</option>
                            <option value="185">Brommystra&#223;e</option>
                            <option value="186">Brommystra&#223;e</option>
                            <option value="187">Bront&#235;weg</option>
                            <option value="188">Bruchsaler Stra&#223;e</option>
                            <option value="189">Buchholzweg</option>
                            <option value="190">Budapester Stra&#223;e</option>
                            <option value="191">Bundesallee</option>
                            <option value="192">Bundesplatz</option>
                            <option value="193">Burgunder Stra&#223;e</option>
                            <option value="194">B&#252;rknersfelder Stra&#223;e</option>
                            <option value="195">B&#252;schingstra&#223;e</option>
                            <option value="196">Byronweg</option>
                            <option value="197">Carionweg</option>
                            <option value="198">Carl-Herz-Ufer</option>
                            <option value="199">Carl-Ludwig-Schleich-Promenade</option>
                            <option value="200">Carmerstra&#223;e</option>
                            <option value="201">Carnotstra&#223;e</option>
                            <option value="202">Caroline-Herschel-Platz</option>
                            <option value="203">Caspar-They&#223;-Stra&#223;e</option>
                            <option value="204">Cauerstra&#223;e</option>
                            <option value="205">Chamierstra&#223;e</option>
                            <option value="206">Chamissoplatz</option>
                            <option value="207">Charlottenbrunner Stra&#223;e</option>
                            <option value="208">Charlottenburger Chaussee</option>
                            <option value="209">Charlottenburger Ufer</option>
                            <option value="210">Charlottenstra&#223;e</option>
                            <option value="211">Christianstra&#223;e</option>
                            <option value="212">Christophstra&#223;e</option>
                            <option value="213">Christstra&#223;e</option>
                            <option value="214">Cicerostra&#223;e</option>
                            <option value="215">Clara-von-Simson-Stra&#223;e</option>
                            <option value="216">Clausewitzstra&#223;e</option>
                            <option value="217">Clayallee</option>
                            <option value="218">Colbestra&#223;e</option>
                            <option value="219">Columbiadamm</option>
                            <option value="220">Comeniusplatz</option>
                            <option value="221">Cordesstra&#223;e</option>
                            <option value="222">Cordesstra&#223;e</option>
                            <option value="223">Corinthstra&#223;e</option>
                            <option value="224">Coubertinplatz</option>
                            <option value="225">Crivitzer Stra&#223;e</option>
                            <option value="226">Crusiusstra&#223;e</option>
                            <option value="227">Cunostra&#223;e</option>
                            <option value="228">Cuvrystra&#223;e</option>
                            <option value="229">Dachsberg</option>
                            <option value="230">D&#228;daluspfad</option>
                            <option value="231">Dahlmannstra&#223;e</option>
                            <option value="232">Dahrendorfzeile</option>
                            <option value="233">Damaschkestra&#223;e</option>
                            <option value="234">Damaschkestra&#223;e</option>
                            <option value="235">Danckelmannstra&#223;e</option>
                            <option value="236">Danneckerstra&#223;e</option>
                            <option value="237">Darmst&#228;dter Stra&#223;e</option>
                            <option value="238">Dar&#223;er Stra&#223;e</option>
                            <option value="239">Darwinstra&#223;e</option>
                            <option value="240">Dasburger Weg</option>
                            <option value="241">Dauerwaldweg</option>
                            <option value="242">Davoser Stra&#223;e</option>
                            <option value="243">Degnerstra&#223;e</option>
                            <option value="244">Deidesheimer Stra&#223;e</option>
                            <option value="245">Delbr&#252;ckstra&#223;e</option>
                            <option value="246">Delpzeile</option>
                            <option value="247">Demminer Stra&#223;e</option>
                            <option value="248">Dennewitzstra&#223;e</option>
                            <option value="249">Dernburgstra&#223;e</option>
                            <option value="250">Dessauer Stra&#223;e</option>
                            <option value="251">Detlevstra&#223;e</option>
                            <option value="252">Detmolder Stra&#223;e</option>
                            <option value="253">Dickensweg</option>
                            <option value="254">Dieffenbachstra&#223;e</option>
                            <option value="255">Dierhagener Stra&#223;e</option>
                            <option value="256">Diestelmeyerstra&#223;e</option>
                            <option value="257">Dietrichstra&#223;e</option>
                            <option value="258">Dievenowstra&#223;e</option>
                            <option value="259">Dillenburger Stra&#223;e</option>
                            <option value="260">Dingelst&#228;dter Stra&#223;e</option>
                            <option value="261">Dirschauer Stra&#223;e</option>
                            <option value="262">Doberaner Stra&#223;e</option>
                            <option value="263">Doberaner Stra&#223;e</option>
                            <option value="264">D&#246;hrendahlstra&#223;e</option>
                            <option value="265">Dolziger Stra&#223;e</option>
                            <option value="266">Dorfstra&#223;e</option>
                            <option value="267">Dorfstra&#223;e</option>
                            <option value="268">Dorfstra&#223;e</option>
                            <option value="269">D&#246;ringstra&#223;e</option>
                            <option value="270">Dossestra&#223;e</option>
                            <option value="271">Douglasstra&#223;e</option>
                            <option value="272">Dovestra&#223;e</option>
                            <option value="273">Dresdener Stra&#223;e</option>
                            <option value="274">Dresselstra&#223;e</option>
                            <option value="275">Drossener Stra&#223;e</option>
                            <option value="276">Droysenstra&#223;e</option>
                            <option value="277">Dudenstra&#223;e</option>
                            <option value="278">Duisburger Stra&#223;e</option>
                            <option value="279">D&#252;nkelbergsteig</option>
                            <option value="280">Durlacher Stra&#223;e</option>
                            <option value="281">D&#252;sseldorfer Stra&#223;e</option>
                            <option value="282">Ebelingstra&#223;e</option>
                            <option value="283">Eberbacher Stra&#223;e</option>
                            <option value="284">Ebereschenallee</option>
                            <option value="285">Eberhard-Roters-Platz</option>
                            <option value="286">Ebertystra&#223;e</option>
                            <option value="287">Eckertstra&#223;e</option>
                            <option value="288">Edgarstra&#223;e</option>
                            <option value="289">Egerstra&#223;e</option>
                            <option value="290">Egon-Erwin-Kisch-Stra&#223;e</option>
                            <option value="291">Ehrenbergstra&#223;e</option>
                            <option value="292">Eichenallee</option>
                            <option value="293">Eichh&#246;rnchensteig</option>
                            <option value="294">Eichkampstra&#223;e</option>
                            <option value="295">Eichkampstra&#223;e</option>
                            <option value="296">Eichkatzweg</option>
                            <option value="297">Einsteinufer</option>
                            <option value="298">Eisenbahnstra&#223;e</option>
                            <option value="299">Eisenzahnstra&#223;e</option>
                            <option value="300">Eislebener Stra&#223;e</option>
                            <option value="301">Eislebener Stra&#223;e</option>
                            <option value="302">Eldenaer Stra&#223;e</option>
                            <option value="303">Elfriedestra&#223;e</option>
                            <option value="304">Elgersburger Stra&#223;e</option>
                            <option value="305">Elisabeth-Schiemann-Stra&#223;e</option>
                            <option value="306">Ellistra&#223;e</option>
                            <option value="307">Elsa-Rendschmidt-Weg</option>
                            <option value="308">Elsastra&#223;e</option>
                            <option value="309">Else-Ury-Bogen</option>
                            <option value="310">Elsterplatz</option>
                            <option value="311">Emmy-Zehden-Weg</option>
                            <option value="312">Emser Platz</option>
                            <option value="313">Emser Stra&#223;e</option>
                            <option value="314">Enckestra&#223;e</option>
                            <option value="315">Englische Stra&#223;e</option>
                            <option value="316">Eosanderstra&#223;e</option>
                            <option value="317">Epiphanienweg</option>
                            <option value="318">Erbacher Stra&#223;e</option>
                            <option value="319">Erdener Stra&#223;e</option>
                            <option value="320">Erich-Steinfurth-Stra&#223;e</option>
                            <option value="321">Erkelenzdamm</option>
                            <option value="322">Ermslebener Weg</option>
                            <option value="323">Ernst-Barlach-Stra&#223;e</option>
                            <option value="324">Ernst-Bumm-Weg</option>
                            <option value="325">Ernst-Reuter-Platz</option>
                            <option value="326">Ernst-Zinna-Weg</option>
                            <option value="327">Eschenallee</option>
                            <option value="328">Ettaler Stra&#223;e</option>
                            <option value="329">Eylauer Stra&#223;e</option>
                            <option value="330">Fabriciusstra&#223;e</option>
                            <option value="331">Falckensteinstra&#223;e</option>
                            <option value="332">Falkenberger Chaussee</option>
                            <option value="333">Falkensteiner Stra&#223;e</option>
                            <option value="334">Falterweg</option>
                            <option value="335">Fanny-Hensel-Weg</option>
                            <option value="336">Fasanenplatz</option>
                            <option value="337">Fasanenstra&#223;e</option>
                            <option value="338">Fasanenstra&#223;e</option>
                            <option value="339">Fechnerstra&#223;e</option>
                            <option value="340">Fehrbelliner Platz</option>
                            <option value="341">Feilnerstra&#223;e</option>
                            <option value="342">Feldtmannstra&#223;e</option>
                            <option value="343">Fennpfuhlweg</option>
                            <option value="344">Ferdinand-Schultze-Stra&#223;e</option>
                            <option value="345">Fichtestra&#223;e</option>
                            <option value="346">Fidicinstra&#223;e</option>
                            <option value="347">Finowstra&#223;e</option>
                            <option value="348">Fischottersteig</option>
                            <option value="349">Fischzug</option>
                            <option value="350">Flatowallee</option>
                            <option value="351">Flinsberger Platz</option>
                            <option value="352">Florentinestra&#223;e</option>
                            <option value="353">Flottwellstra&#223;e</option>
                            <option value="354">Fontanepromenade</option>
                            <option value="355">Fontanestra&#223;e</option>
                            <option value="356">Forckenbeckplatz</option>
                            <option value="357">Forckenbeckstra&#223;e</option>
                            <option value="358">Forster Stra&#223;e</option>
                            <option value="359">Fraenkelufer</option>
                            <option value="360">Frankenallee</option>
                            <option value="361">Frankfurter Allee</option>
                            <option value="362">Frankfurter Tor</option>
                            <option value="363">Franklinstra&#223;e</option>
                            <option value="364">Franz-Cornelsen-Weg</option>
                            <option value="365">Franzensbader Stra&#223;e</option>
                            <option value="366">Franz-Kl&#252;hs-Stra&#223;e</option>
                            <option value="367">Franz-K&#252;nstler-Stra&#223;e</option>
                            <option value="368">Franz-Mehring-Platz</option>
                            <option value="369">Frauenburger Pfad</option>
                            <option value="370">Fraunhoferstra&#223;e</option>
                            <option value="371">Fredericiastra&#223;e</option>
                            <option value="372">Fredersdorfer Stra&#223;e</option>
                            <option value="373">Freienwalder Stra&#223;e</option>
                            <option value="374">Freiligrathstra&#223;e</option>
                            <option value="375">Friedbergstra&#223;e</option>
                            <option value="376">Friedhofstra&#223;e</option>
                            <option value="377">Friedrich-Friesen-Allee</option>
                            <option value="378">Friedrich-Junge-Stra&#223;e</option>
                            <option value="379">Friedrich-Olbricht-Damm</option>
                            <option value="380">Friedrichsberger Stra&#223;e</option>
                            <option value="381">Friedrichshaller Stra&#223;e</option>
                            <option value="382">Friedrich-Stampfer-Stra&#223;e</option>
                            <option value="383">Friedrichstra&#223;e</option>
                            <option value="384">Friesenstra&#223;e</option>
                            <option value="385">Frischlingsteig</option>
                            <option value="386">Fritschestra&#223;e</option>
                            <option value="387">Fritz-Lesch-Stra&#223;e</option>
                            <option value="388">Fritz-Schiff-Weg</option>
                            <option value="389">Fritz-Wildung-Stra&#223;e</option>
                            <option value="390">F&#252;rbringerstra&#223;e</option>
                            <option value="391">F&#252;rstenbrunner Weg</option>
                            <option value="392">F&#252;rstenplatz</option>
                            <option value="393">F&#252;rstenwalder Stra&#223;e</option>
                            <option value="394">F&#252;rther Stra&#223;e</option>
                            <option value="395">Furtw&#228;nglerstra&#223;e</option>
                            <option value="396">Gabelsbergerstra&#223;e</option>
                            <option value="397">Gabriel-Max-Stra&#223;e</option>
                            <option value="398">Gallesteig</option>
                            <option value="399">Galvanistra&#223;e</option>
                            <option value="400">Gardes-du-Corps-Stra&#223;e</option>
                            <option value="401">G&#228;rtnerstra&#223;e</option>
                            <option value="402">G&#228;rtnerstra&#223;e</option>
                            <option value="403">Gasteiner Stra&#223;e</option>
                            <option value="404">Gau&#223;stra&#223;e</option>
                            <option value="405">Gehrenseestra&#223;e</option>
                            <option value="406">Geibelstra&#223;e</option>
                            <option value="407">Geisbergstra&#223;e</option>
                            <option value="408">Geisenheimer Stra&#223;e</option>
                            <option value="409">Gei&#223;lerpfad</option>
                            <option value="410">Geitelsteig</option>
                            <option value="411">Gembitzer Stra&#223;e</option>
                            <option value="412">Genossenschaftsweg</option>
                            <option value="413">Genslerstra&#223;e</option>
                            <option value="414">George-Grosz-Platz</option>
                            <option value="415">Georgenkirchstra&#223;e</option>
                            <option value="416">Georg-Wilhelm-Stra&#223;e</option>
                            <option value="417">Gerdauer Stra&#223;e</option>
                            <option value="418">Gerolsteiner Stra&#223;e</option>
                            <option value="419">Gertrudstra&#223;e</option>
                            <option value="420">Gervinusstra&#223;e</option>
                            <option value="421">Gerzlower Stra&#223;e</option>
                            <option value="422">Gierkeplatz</option>
                            <option value="423">Gierkezeile</option>
                            <option value="424">Giesebrechtstra&#223;e</option>
                            <option value="425">Gieselerstra&#223;e</option>
                            <option value="426">Gitschiner Stra&#223;e</option>
                            <option value="427">Glasbl&#228;serallee</option>
                            <option value="428">Glatzer Stra&#223;e</option>
                            <option value="429">Glockenturmstra&#223;e</option>
                            <option value="430">Gloedenpfad</option>
                            <option value="431">Glogauer Stra&#223;e</option>
                            <option value="432">Gneisenaustra&#223;e</option>
                            <option value="433">Goebelplatz</option>
                            <option value="434">Goebelstra&#223;e</option>
                            <option value="435">Goeckestra&#223;e</option>
                            <option value="436">Goerdelerdamm</option>
                            <option value="437">Goethepark</option>
                            <option value="438">Goethestra&#223;e</option>
                            <option value="439">Gol&#223;ener Stra&#223;e</option>
                            <option value="440">G&#246;rlitzer Stra&#223;e</option>
                            <option value="441">G&#246;rlitzer Ufer</option>
                            <option value="442">Goslarer Platz</option>
                            <option value="443">Goslarer Ufer</option>
                            <option value="444">Gotha-Allee</option>
                            <option value="445">Gottfried-Keller-Stra&#223;e</option>
                            <option value="446">Gottfriedstra&#223;e</option>
                            <option value="447">Graaler Weg</option>
                            <option value="448">Graefestra&#223;e</option>
                            <option value="449">Graudenzer Stra&#223;e</option>
                            <option value="450">Grenzgrabenstra&#223;e</option>
                            <option value="451">Grethe-Weiser-Weg</option>
                            <option value="452">Grevesm&#252;hlener Stra&#223;e</option>
                            <option value="453">Grimmstra&#223;e</option>
                            <option value="454">Gr&#246;benufer</option>
                            <option value="455">Grolmanstra&#223;e</option>
                            <option value="456">Gropiusstra&#223;e</option>
                            <option value="457">Gro&#223;beerenstra&#223;e</option>
                            <option value="458">Gro&#223;e-Leege-Stra&#223;e</option>
                            <option value="459">Gr&#252;nberger Stra&#223;e</option>
                            <option value="460">Gryphiusstra&#223;e</option>
                            <option value="461">Gubener Stra&#223;e</option>
                            <option value="462">Guerickestra&#223;e</option>
                            <option value="463">G&#252;rtelstra&#223;e</option>
                            <option value="464">Gutenbergstra&#223;e</option>
                            <option value="465">Gutsmuthsweg</option>
                            <option value="466">Haasestra&#223;e</option>
                            <option value="467">Habermannzeile</option>
                            <option value="468">Haeftenzeile</option>
                            <option value="469">Hafenplatz</option>
                            <option value="470">Hagelberger Stra&#223;e</option>
                            <option value="471">Hagenower Ring</option>
                            <option value="472">Halemweg</option>
                            <option value="473">Halenseestra&#223;e</option>
                            <option value="474">Hallerstra&#223;e</option>
                            <option value="475">Hallesche Stra&#223;e</option>
                            <option value="476">Hallesches Ufer</option>
                            <option value="477">Halmstra&#223;e</option>
                            <option value="478">Hammarskj&#246;ldplatz</option>
                            <option value="479">Hannah-Karminski-Stra&#223;e</option>
                            <option value="480">Hanns-Braun-Stra&#223;e</option>
                            <option value="481">Hansastra&#223;e</option>
                            <option value="482">Harbigstra&#223;e</option>
                            <option value="483">Hardenbergplatz</option>
                            <option value="484">Hardenbergstra&#223;e</option>
                            <option value="485">Hardyweg</option>
                            <option value="486">Harlingeroder Weg</option>
                            <option value="487">Hasenheide</option>
                            <option value="488">Haubachstra&#223;e</option>
                            <option value="489">Hauptstra&#223;e</option>
                            <option value="490">Hausburgstra&#223;e</option>
                            <option value="491">Hausvaterweg</option>
                            <option value="492">Havelchaussee</option>
                            <option value="493">Hebbelstra&#223;e</option>
                            <option value="494">Heckelberger Ring</option>
                            <option value="495">Heckerdamm</option>
                            <option value="496">Heckmannufer</option>
                            <option value="497">Hedemannstra&#223;e</option>
                            <option value="498">Hedwigstra&#223;e</option>
                            <option value="499">Hedwig-Wachenheim-Stra&#223;e</option>
                            <option value="500">Heerstra&#223;e</option>
                            <option value="501">Heidenfeldstra&#223;e</option>
                            <option value="502">Heiligenstadter Stra&#223;e</option>
                            <option value="503">Heilmannring</option>
                            <option value="504">Heilsberger Allee</option>
                            <option value="505">Heimstra&#223;e</option>
                            <option value="506">Heinickeweg</option>
                            <option value="507">Heinrichplatz</option>
                            <option value="508">Heisenbergstra&#223;e</option>
                            <option value="509">Heldburger Stra&#223;e</option>
                            <option value="510">Helenenhof</option>
                            <option value="511">Helen-Ernst-Stra&#223;e</option>
                            <option value="512">Hellersdorfer Weg</option>
                            <option value="513">Helmerdingstra&#223;e</option>
                            <option value="514">Helmholtzstra&#223;e</option>
                            <option value="515">Helminestra&#223;e</option>
                            <option value="516">Helsingforser Platz</option>
                            <option value="517">Helsingforser Stra&#223;e</option>
                            <option value="518">Hempelsteig</option>
                            <option value="519">Herbartstra&#223;e</option>
                            <option value="520">Herbert-Lewin-Platz</option>
                            <option value="521">Herderstra&#223;e</option>
                            <option value="522">Hermannplatz</option>
                            <option value="523">Herschelstra&#223;e</option>
                            <option value="524">Hertastra&#223;e</option>
                            <option value="525">Hertzallee</option>
                            <option value="526">Hessenallee</option>
                            <option value="527">Heubnerweg</option>
                            <option value="528">Hildegard-Jadamowitz-Stra&#223;e</option>
                            <option value="529">Hindemithplatz</option>
                            <option value="530">historisch </option>
                            <option value="531">historisch </option>
                            <option value="532">H&#246;chste Stra&#223;e</option>
                            <option value="533">Hofackerzeile</option>
                            <option value="534">Hofheimer Stra&#223;e</option>
                            <option value="535">Hohengraper Weg</option>
                            <option value="536">Hohensch&#246;nhauser Stra&#223;e</option>
                            <option value="537">Hohensch&#246;nhauser Weg</option>
                            <option value="538">Hohenstaufenplatz</option>
                            <option value="539">Hohensteinallee</option>
                            <option value="540">H&#246;lderlinstra&#223;e</option>
                            <option value="541">Holteistra&#223;e</option>
                            <option value="542">Holtzendorffplatz</option>
                            <option value="543">Holtzendorffstra&#223;e</option>
                            <option value="544">Holzmarktstra&#223;e</option>
                            <option value="545">Hornstra&#223;e</option>
                            <option value="546">Horstweg</option>
                            <option value="547">H&#252;bnerstra&#223;e</option>
                            <option value="548">H&#252;ttigpfad</option>
                            <option value="549">Iburger Ufer</option>
                            <option value="550">Ida-Wolff-Platz</option>
                            <option value="551">Ilsenburger Stra&#223;e</option>
                            <option value="552">Im Hornisgrund</option>
                            <option value="553">Indira-Gandhi-Stra&#223;e</option>
                            <option value="554">Insterburgallee</option>
                            <option value="555">Jaff&#233;stra&#223;e</option>
                            <option value="556">Jahnstra&#223;e</option>
                            <option value="557">Jakobikirchstra&#223;e</option>
                            <option value="558">Jakob-Kaiser-Platz</option>
                            <option value="559">Jasminweg</option>
                            <option value="560">Jeanne-Mammen-Bogen</option>
                            <option value="561">Jebensstra&#223;e</option>
                            <option value="562">Jerusalemer Stra&#223;e</option>
                            <option value="563">Jesse-Owens-Allee</option>
                            <option value="564">Jessnerstra&#223;e</option>
                            <option value="565">Joachimstaler Platz</option>
                            <option value="566">Joachimstaler Stra&#223;e</option>
                            <option value="567">Joachimsthaler Stra&#223;e</option>
                            <option value="568">Johannisburger Allee</option>
                            <option value="569">Johanniterstra&#223;e</option>
                            <option value="570">Johann-Jacob-Engel-Stra&#223;e</option>
                            <option value="571">Jollenseglerstra&#223;e</option>
                            <option value="572">Josef-H&#246;hn-Stra&#223;e</option>
                            <option value="573">Julius-Meyen-Stra&#223;e</option>
                            <option value="574">Jungfernheideweg</option>
                            <option value="575">Jungstra&#223;e</option>
                            <option value="576">J&#252;terboger Stra&#223;e</option>
                            <option value="577">Kadiner Stra&#223;e</option>
                            <option value="578">Kaiserdamm</option>
                            <option value="579">Kaiser-Friedrich-Stra&#223;e</option>
                            <option value="580">Kaiserin-Augusta-Allee</option>
                            <option value="581">Kamminer Stra&#223;e</option>
                            <option value="582">Kantstra&#223;e</option>
                            <option value="583">Karl-August-Platz</option>
                            <option value="584">Karl-Marx-Allee</option>
                            <option value="585">Karolingerplatz</option>
                            <option value="586">Kastanienallee</option>
                            <option value="587">K&#228;theplatz</option>
                            <option value="588">K&#228;thestra&#223;e</option>
                            <option value="589">Katzbachstra&#223;e</option>
                            <option value="590">Keplerstra&#223;e</option>
                            <option value="591">Kiefernweg</option>
                            <option value="592">Kinzigstra&#223;e</option>
                            <option value="593">Kiplingweg</option>
                            <option value="594">Kirchnerpfad</option>
                            <option value="595">Kirschenallee</option>
                            <option value="596">Klarastra&#223;e</option>
                            <option value="597">Kl&#228;re-Bloch-Platz</option>
                            <option value="598">Klausenerplatz</option>
                            <option value="599">Klaus-Groth-Stra&#223;e</option>
                            <option value="600">Klausingring</option>
                            <option value="601">Klaustaler Stra&#223;e</option>
                            <option value="602">Kleinbeerenstra&#223;e</option>
                            <option value="603">Kleine Andreasstra&#223;e</option>
                            <option value="604">Kleine Markusstra&#223;e</option>
                            <option value="605">Kleine Parkstra&#223;e</option>
                            <option value="606">Kloedenstra&#223;e</option>
                            <option value="607">Kl&#252;tzer Stra&#223;e</option>
                            <option value="608">Knesebeckstra&#223;e</option>
                            <option value="609">Knobelsdorffstra&#223;e</option>
                            <option value="610">Knorrpromenade</option>
                            <option value="611">Koburgallee</option>
                            <option value="612">Kochhannstra&#223;e</option>
                            <option value="613">Kochstra&#223;e</option>
                            <option value="614">Kohlfurter Stra&#223;e</option>
                            <option value="615">Kohlrauschstra&#223;e</option>
                            <option value="616">Kollatzstra&#223;e</option>
                            <option value="617">Kommandantenstra&#223;e</option>
                            <option value="618">K&#246;nigin-Elisabeth-Stra&#223;e</option>
                            <option value="619">K&#246;nigswalder Stra&#223;e</option>
                            <option value="620">Konitzer Stra&#223;e</option>
                            <option value="621">Konrad-Wolf-Stra&#223;e</option>
                            <option value="622">K&#246;penicker Stra&#223;e</option>
                            <option value="623">Kopernikusstra&#223;e</option>
                            <option value="624">Kopischstra&#223;e</option>
                            <option value="625">Koppenstra&#223;e</option>
                            <option value="626">K&#246;rtestra&#223;e</option>
                            <option value="627">K&#246;thener Stra&#223;e</option>
                            <option value="628">Kottbusser Damm</option>
                            <option value="629">Kottbusser Stra&#223;e</option>
                            <option value="630">Krachtstra&#223;e</option>
                            <option value="631">Kranzallee</option>
                            <option value="632">Krautstra&#223;e</option>
                            <option value="633">Kreutzigerstra&#223;e</option>
                            <option value="634">Kreuzbergstra&#223;e</option>
                            <option value="635">Kr&#246;peliner Stra&#223;e</option>
                            <option value="636">Krossener Stra&#223;e</option>
                            <option value="637">Krumme Stra&#223;e</option>
                            <option value="638">Kucharskistra&#223;e</option>
                            <option value="639">K&#252;hler Weg</option>
                            <option value="640">K&#252;hlungsborner Stra&#223;e</option>
                            <option value="641">K&#252;llstedter Stra&#223;e</option>
                            <option value="642">Kundtanger</option>
                            <option value="643">Kuno-Fischer-Platz</option>
                            <option value="644">Kuno-Fischer-Stra&#223;e</option>
                            <option value="645">Kurf&#252;rstendamm</option>
                            <option value="646">Kurl&#228;nder Allee</option>
                            <option value="647">Kurt-Schumacher-Damm</option>
                            <option value="648">K&#252;striner Stra&#223;e</option>
                            <option value="649">Kyllburger Weg</option>
                            <option value="650">Kynaststra&#223;e</option>
                            <option value="651">Lachmannstra&#223;e</option>
                            <option value="652">Lambertstra&#223;e</option>
                            <option value="653">L&#228;nderallee</option>
                            <option value="654">Landsberger Allee</option>
                            <option value="655">Landsberger Allee</option>
                            <option value="656">Lange Stra&#223;e</option>
                            <option value="657">Langenbeckstra&#223;e</option>
                            <option value="658">Langobardenallee</option>
                            <option value="659">L&#228;rchenweg</option>
                            <option value="660">Lasdehner Stra&#223;e</option>
                            <option value="661">Laskerstra&#223;e</option>
                            <option value="662">Lausitzer Platz</option>
                            <option value="663">Lausitzer Stra&#223;e</option>
                            <option value="664">Lebuser Stra&#223;e</option>
                            <option value="665">Legiendamm</option>
                            <option value="666">Lehmbruckstra&#223;e</option>
                            <option value="667">Lehniner Platz</option>
                            <option value="668">Leibnizstra&#223;e</option>
                            <option value="669">Leistikowstra&#223;e</option>
                            <option value="670">Lenbachstra&#223;e</option>
                            <option value="671">Leonhardtstra&#223;e</option>
                            <option value="672">Lerschpfad</option>
                            <option value="673">Letterhausweg</option>
                            <option value="674">Leuenberger Stra&#223;e</option>
                            <option value="675">Leuningerpfad</option>
                            <option value="676">Leuschnerdamm</option>
                            <option value="677">Lewishamstra&#223;e</option>
                            <option value="678">Libauer Stra&#223;e</option>
                            <option value="679">Lichtenauer Stra&#223;e</option>
                            <option value="680">Lichtenberger Stra&#223;e</option>
                            <option value="681">Liebenwalder Stra&#223;e</option>
                            <option value="682">Liebigstra&#223;e</option>
                            <option value="683">Liegnitzer Stra&#223;e</option>
                            <option value="684">Lietzenburger Stra&#223;e</option>
                            <option value="685">Lietzenseeufer</option>
                            <option value="686">Lilienthalstra&#223;e</option>
                            <option value="687">Lindenallee</option>
                            <option value="688">Lindenberger Stra&#223;e</option>
                            <option value="689">Lindenweg</option>
                            <option value="690">Lise-Meitner-Stra&#223;e</option>
                            <option value="691">Lobeckstra&#223;e</option>
                            <option value="692">Lohmeyerstra&#223;e</option>
                            <option value="693">Lohm&#252;hlenstra&#223;e</option>
                            <option value="694">Los-Angeles-Platz</option>
                            <option value="695">Loschmidtstra&#223;e</option>
                            <option value="696">L&#246;ssauer Stra&#223;e</option>
                            <option value="697">Lotharstra&#223;e</option>
                            <option value="698">Lotte-Lenya-Bogen</option>
                            <option value="699">L&#246;tzener Allee</option>
                            <option value="700">L&#246;westra&#223;e</option>
                            <option value="701">L&#252;bbener Stra&#223;e</option>
                            <option value="702">Luckauer Stra&#223;e</option>
                            <option value="703">Luckenwalder Stra&#223;e</option>
                            <option value="704">L&#252;dtgeweg</option>
                            <option value="705">Ludwig-Pick-Stra&#223;e</option>
                            <option value="706">Luisenplatz</option>
                            <option value="707">Lukasstra&#223;e</option>
                            <option value="708">Lyckallee</option>
                            <option value="709">Machandelweg</option>
                            <option value="710">Maik&#228;ferpfad</option>
                            <option value="711">Mainzer Stra&#223;e</option>
                            <option value="712">Malchower Weg</option>
                            <option value="713">Manetstra&#223;e</option>
                            <option value="714">Manteuffelstra&#223;e</option>
                            <option value="715">Marathonallee</option>
                            <option value="716">Marburger Stra&#223;e</option>
                            <option value="717">M&#228;rchenweg</option>
                            <option value="718">Marchlewskistra&#223;e</option>
                            <option value="719">Marchstra&#223;e</option>
                            <option value="720">Margarete-K&#252;hn-Stra&#223;e</option>
                            <option value="721">Marheinekeplatz</option>
                            <option value="722">Mariane-von-Rantzau-Stra&#223;e</option>
                            <option value="723">Mariannenplatz</option>
                            <option value="724">Marie-Elisabeth-L&#252;ders-Stra&#223;e</option>
                            <option value="725">Marie-Elisabeth-von-Humboldt-Stra&#223;e</option>
                            <option value="726">Marie-Luise-Stra&#223;e</option>
                            <option value="727">Marienburger Allee</option>
                            <option value="728">Markgrafendamm</option>
                            <option value="729">Marzahner Stra&#223;e</option>
                            <option value="730">Masurenallee</option>
                            <option value="731">Matenzeile</option>
                            <option value="732">Matkowskystra&#223;e</option>
                            <option value="733">Matternstra&#223;e</option>
                            <option value="734">Matthiasstra&#223;e</option>
                            <option value="735">Max-Dohrn-Stra&#223;e</option>
                            <option value="736">Meerscheidtstra&#223;e</option>
                            <option value="737">Meinekestra&#223;e</option>
                            <option value="738">Meiningenallee</option>
                            <option value="739">Merowingerweg</option>
                            <option value="740">Messedamm</option>
                            <option value="741">Meusebachstra&#223;e</option>
                            <option value="742">Meyerinckplatz</option>
                            <option value="743">Mierendorffplatz</option>
                            <option value="744">Mierendorffstra&#223;e</option>
                            <option value="745">Miltonweg</option>
                            <option value="746">Mindener Stra&#223;e</option>
                            <option value="747">Mittelstra&#223;e</option>
                            <option value="748">Mohrunger Allee</option>
                            <option value="749">Mollwitzstra&#223;e</option>
                            <option value="750">Mommsenstra&#223;e</option>
                            <option value="751">Morsestra&#223;e</option>
                            <option value="752">M&#252;ller-Breslau-Stra&#223;e</option>
                            <option value="753">Murellenweg</option>
                            <option value="754">Nehringstra&#223;e</option>
                            <option value="755">Neidenburger Allee</option>
                            <option value="756">Neubrandenburger Stra&#223;e</option>
                            <option value="757">Neue Christstra&#223;e</option>
                            <option value="758">Neue Kantstra&#223;e</option>
                            <option value="759">Neufertstra&#223;e</option>
                            <option value="760">Neustrelitzer Stra&#223;e</option>
                            <option value="761">Neuzeller Weg</option>
                            <option value="762">Niebuhrstra&#223;e</option>
                            <option value="763">Niehofer Stra&#223;e</option>
                            <option value="764">Nienhagener Stra&#223;e</option>
                            <option value="765">Nikolaus-Gro&#223;-Weg</option>
                            <option value="766">Nithackstra&#223;e</option>
                            <option value="767">Nonnendamm</option>
                            <option value="768">Norbertstra&#223;e</option>
                            <option value="769">Nordhauser Stra&#223;e</option>
                            <option value="770">Nu&#223;baumallee</option>
                            <option value="771">Oberseeplatz</option>
                            <option value="772">Oberseestra&#223;e</option>
                            <option value="773">Olbersstra&#223;e</option>
                            <option value="774">Oldenburgallee</option>
                            <option value="775">Olivaer Platz</option>
                            <option value="776">Olympische Stra&#223;e</option>
                            <option value="777">Olympischer Platz</option>
                            <option value="778">Orankestrand</option>
                            <option value="779">Orankestra&#223;e</option>
                            <option value="780">Orankeweg</option>
                            <option value="781">Ortelsburger Allee</option>
                            <option value="782">Osnabr&#252;cker Stra&#223;e</option>
                            <option value="783">Oswaldstra&#223;e</option>
                            <option value="784">Otto-Dibelius-Stra&#223;e</option>
                            <option value="785">Otto-Gr&#252;neberg-Weg</option>
                            <option value="786">Otto-Ludwig-Stra&#223;e</option>
                            <option value="787">Otto-Suhr-Allee</option>
                            <option value="788">Pablo-Picasso-Stra&#223;e</option>
                            <option value="789">Papendickstra&#223;e</option>
                            <option value="790">Pascalstra&#223;e</option>
                            <option value="791">Passenheimer Stra&#223;e</option>
                            <option value="792">Passower Stra&#223;e</option>
                            <option value="793">Paul-Koenig-Stra&#223;e</option>
                            <option value="794">Perler Stra&#223;e</option>
                            <option value="795">Pestalozzistra&#223;e</option>
                            <option value="796">Philippistra&#223;e</option>
                            <option value="797">Pillkaller Allee</option>
                            <option value="798">Platanenallee</option>
                            <option value="799">Plauener Stra&#223;e</option>
                            <option value="800">Pommernallee</option>
                            <option value="801">Popitzweg</option>
                            <option value="802">Prendener Stra&#223;e</option>
                            <option value="803">Prerower Platz</option>
                            <option value="804">Preu&#223;enallee</option>
                            <option value="805">Privatstra&#223;e 1</option>
                            <option value="806">Privatstra&#223;e 10</option>
                            <option value="807">Privatstra&#223;e 12</option>
                            <option value="808">Privatstra&#223;e 2</option>
                            <option value="809">Privatstra&#223;e 3</option>
                            <option value="810">Privatstra&#223;e 4</option>
                            <option value="811">Privatstra&#223;e 5</option>
                            <option value="812">Privatstra&#223;e 6</option>
                            <option value="813">Privatstra&#223;e 7</option>
                            <option value="814">Privatstra&#223;e 8</option>
                            <option value="815">Privatstra&#223;e 9</option>
                            <option value="816">Pulsstra&#223;e</option>
                            <option value="817">Quedlinburger Stra&#223;e</option>
                            <option value="818">Rackwitzer Stra&#223;e</option>
                            <option value="819">Ragniter Allee</option>
                            <option value="820">Randowstra&#223;e</option>
                            <option value="821">Rankeplatz</option>
                            <option value="822">Rankestra&#223;e</option>
                            <option value="823">Ratzeburger Allee</option>
                            <option value="824">Rauschener Allee</option>
                            <option value="825">Rau&#223;endorffplatz</option>
                            <option value="826">Reichenberger Stra&#223;e</option>
                            <option value="827">Reichsstra&#223;e</option>
                            <option value="828">Reichweindamm</option>
                            <option value="829">Reriker Stra&#223;e</option>
                            <option value="830">Reu&#223;allee</option>
                            <option value="831">Rhinstra&#223;e</option>
                            <option value="832">Ribnitzer Stra&#223;e</option>
                            <option value="833">Ricardastra&#223;e</option>
                            <option value="834">Richard-Wagner-Platz</option>
                            <option value="835">Richard-Wagner-Stra&#223;e</option>
                            <option value="836">Riedemannweg</option>
                            <option value="837">Riehlstra&#223;e</option>
                            <option value="838">Roderichplatz</option>
                            <option value="839">Roedernstra&#223;e</option>
                            <option value="840">Rognitzstra&#223;e</option>
                            <option value="841">Rominter Allee</option>
                            <option value="842">R&#246;nnestra&#223;e</option>
                            <option value="843">R&#246;ntgenstra&#223;e</option>
                            <option value="844">Roscherstra&#223;e</option>
                            <option value="845">Rossitter Platz</option>
                            <option value="846">Rossitter Weg</option>
                            <option value="847">Rostocker Stra&#223;e</option>
                            <option value="848">Rotkamp</option>
                            <option value="849">Rottannenweg</option>
                            <option value="850">R&#246;ttkenring</option>
                            <option value="851">R&#252;ckertstra&#223;e</option>
                            <option value="852">R&#252;dickenstra&#223;e</option>
                            <option value="853">Ruhwaldweg</option>
                            <option value="854">R&#252;sternallee</option>
                            <option value="855">Saatwinkler Damm</option>
                            <option value="856">Sabinensteig</option>
                            <option value="857">Saldernstra&#223;e</option>
                            <option value="858">Salzufer</option>
                            <option value="859">Sandinostra&#223;e</option>
                            <option value="860">Sarkauer Allee</option>
                            <option value="861">Savignyplatz</option>
                            <option value="862">Schalkauer Stra&#223;e</option>
                            <option value="863">Scharnweberstra&#223;e</option>
                            <option value="864">Schaumburgallee</option>
                            <option value="865">Scheinerweg</option>
                            <option value="866">Schillerstra&#223;e</option>
                            <option value="867">Schirwindter Allee</option>
                            <option value="868">Schleizer Stra&#223;e</option>
                            <option value="869">Schlesingerstra&#223;e</option>
                            <option value="870">Schlo&#223;stra&#223;e</option>
                            <option value="871">Schl&#252;terstra&#223;e</option>
                            <option value="872">Schneppenhorstweg</option>
                            <option value="873">Scholzplatz</option>
                            <option value="874">Sch&#246;neicher Stra&#223;e</option>
                            <option value="875">Schustehrusstra&#223;e</option>
                            <option value="876">Schwambzeile</option>
                            <option value="877">Schwanenfeldstra&#223;e</option>
                            <option value="878">Schwarzer Weg</option>
                            <option value="879">Schweiggerweg</option>
                            <option value="880">Schweriner Ring</option>
                            <option value="881">Scottweg</option>
                            <option value="882">Seefelder Stra&#223;e</option>
                            <option value="883">Seehausener Stra&#223;e</option>
                            <option value="884">Seelingstra&#223;e</option>
                            <option value="885">Seestra&#223;e</option>
                            <option value="886">Sensburger Allee</option>
                            <option value="887">Sesenheimer Stra&#223;e</option>
                            <option value="888">Shakespeareplatz</option>
                            <option value="889">Shawweg</option>
                            <option value="890">Sickingenstra&#223;e</option>
                            <option value="891">Siemensdamm</option>
                            <option value="892">Sigrunstra&#223;e</option>
                            <option value="893">Silingenweg</option>
                            <option value="894">Simon-Bolivar-Stra&#223;e</option>
                            <option value="895">Skirenweg</option>
                            <option value="896">Soldauer Allee</option>
                            <option value="897">Soldauer Platz</option>
                            <option value="898">Sollstedter Stra&#223;e</option>
                            <option value="899">S&#246;mmeringstra&#223;e</option>
                            <option value="900">Sonnenhof</option>
                            <option value="901">Soorstra&#223;e</option>
                            <option value="902">Sophie-Charlotten-Stra&#223;e</option>
                            <option value="903">Sophie-Charlotte-Platz</option>
                            <option value="904">Spandauer Damm</option>
                            <option value="905">Spiegelweg</option>
                            <option value="906">Spielhagenstra&#223;e</option>
                            <option value="907">Sportforumstra&#223;e</option>
                            <option value="908">Spreetalallee</option>
                            <option value="909">Stallstra&#223;e</option>
                            <option value="910">Stallup&#246;ner Allee</option>
                            <option value="911">Stegeweg</option>
                            <option value="912">Steifensandstra&#223;e</option>
                            <option value="913">Steinplatz</option>
                            <option value="914">Stendelweg</option>
                            <option value="915">Steubenplatz</option>
                            <option value="916">Stieffring</option>
                            <option value="917">Stormstra&#223;e</option>
                            <option value="918">Stra&#223;e des 17. Juni</option>
                            <option value="919">Strausberger Platz</option>
                            <option value="920">Strausberger Stra&#223;e</option>
                            <option value="921">Str&#252;nckweg</option>
                            <option value="922">Struvesteig</option>
                            <option value="923">Stuhmer Allee</option>
                            <option value="924">St&#252;lpnagelstra&#223;e</option>
                            <option value="925">Stuttgarter Platz</option>
                            <option value="926">Suarezstra&#223;e</option>
                            <option value="927">S&#252;dtorweg</option>
                            <option value="928">Suermondtstra&#223;e</option>
                            <option value="929">Swiftweg</option>
                            <option value="930">Sybelstra&#223;e</option>
                            <option value="931">Tamseler Stra&#223;e</option>
                            <option value="932">Tannenbergallee</option>
                            <option value="933">Tapiauer Allee</option>
                            <option value="934">Tauentzienstra&#223;e</option>
                            <option value="935">Tauroggener Stra&#223;e</option>
                            <option value="936">Tegeler Weg</option>
                            <option value="937">Teichgr&#228;berzeile</option>
                            <option value="938">Terwielsteig</option>
                            <option value="939">Teufelsseestra&#223;e</option>
                            <option value="940">Tharauer Allee</option>
                            <option value="941">Thaters Privatweg</option>
                            <option value="942">Themarer Stra&#223;e</option>
                            <option value="943">Theobaldstra&#223;e</option>
                            <option value="944">Theodor-Heuss-Platz</option>
                            <option value="945">Thrasoltstra&#223;e</option>
                            <option value="946">Th&#252;ringerallee</option>
                            <option value="947">Titastra&#223;e</option>
                            <option value="948">Toeplerstra&#223;e</option>
                            <option value="949">Trakehner Allee</option>
                            <option value="950">Treffurter Stra&#223;e</option>
                            <option value="951">Treidelweg</option>
                            <option value="952">Trendelenburgstra&#223;e</option>
                            <option value="953">Treseburger Stra&#223;e</option>
                            <option value="954">Ubierstra&#223;e</option>
                            <option value="955">Uhlandstra&#223;e</option>
                            <option value="956">Ulmenallee</option>
                            <option value="957">Verdener Gasse</option>
                            <option value="958">Vereinsweg</option>
                            <option value="959">Vincent-van-Gogh-Stra&#223;e</option>
                            <option value="960">Wacholderweg</option>
                            <option value="961">Waitzstra&#223;e</option>
                            <option value="962">Waldowstra&#223;e</option>
                            <option value="963">Waldschulallee</option>
                            <option value="964">Walter-Benjamin-Platz</option>
                            <option value="965">Wandalenallee</option>
                            <option value="966">Warburgzeile</option>
                            <option value="967">Warnem&#252;nder Stra&#223;e</option>
                            <option value="968">Warnenweg</option>
                            <option value="969">Warnitzer Stra&#223;e</option>
                            <option value="970">Wartenberger Stra&#223;e</option>
                            <option value="971">Wartenberger Weg</option>
                            <option value="972">Wartiner Stra&#223;e</option>
                            <option value="973">Wassergrundstra&#223;e</option>
                            <option value="974">Wegelystra&#223;e</option>
                            <option value="975">Weimarer Stra&#223;e</option>
                            <option value="976">Wei&#223;enseer Weg</option>
                            <option value="977">Welsestra&#223;e</option>
                            <option value="978">Werneuchener Stra&#223;e</option>
                            <option value="979">Wernigeroder Stra&#223;e</option>
                            <option value="980">Westendallee</option>
                            <option value="981">Wiecker Stra&#223;e</option>
                            <option value="982">Wielandstra&#223;e</option>
                            <option value="983">Wiersichweg</option>
                            <option value="984">Wiesendamm</option>
                            <option value="985">Willenberger Pfad</option>
                            <option value="986">Wilmersdorfer Stra&#223;e</option>
                            <option value="987">Windscheidstra&#223;e</option>
                            <option value="988">Wintersteinstra&#223;e</option>
                            <option value="989">Wirmerzeile</option>
                            <option value="990">Witzenhauser Stra&#223;e</option>
                            <option value="991">Witzlebenplatz</option>
                            <option value="992">Witzlebenstra&#223;e</option>
                            <option value="993">Woldegker Stra&#223;e</option>
                            <option value="994">Wollenberger Stra&#223;e</option>
                            <option value="995">Worbiser Stra&#223;e</option>
                            <option value="996">Wriezener Stra&#223;e</option>
                            <option value="997">Wulfsheinstra&#223;e</option>
                            <option value="998">Wundtstra&#223;e</option>
                            <option value="999">W&#252;rttembergallee</option>
                            <option value="1000">Wustrower Stra&#223;e</option>
                            <option value="1001">Zauritzweg</option>
                            <option value="1002">Zechliner Stra&#223;e</option>
                            <option value="1003">Zikadenweg</option>
                            <option value="1004">Zillestra&#223;e</option>
                            <option value="1005">Zingster Stra&#223;e</option>
                            <option value="1006">Zu den Krugwiesen</option>
                            <option value="1007">Zum Hechtgraben</option>
                        </select>
                        <p>
                            CURRENT SELECTED: <span id="value">&nbsp;</span>
                        </p>
                        <h2>
                            Test options:
                        </h2>
                        <p>
                            <select id="maxListSize">
                                <option value="50">25</option>
                                <option value="50">50</option>
                                <option value="100" selected="selected">100</option>
                                <option value="150">150</option>
                                <option value="200">200</option>
                                <option value="300">300</option>
                            </select>
                            Max list size
                        </p>
                        <p>
                            <select id="maxMultiMatch">
                                <option value="50">25</option>
                                <option value="50" selected="selected">50</option>
                                <option value="100">100</option>
                                <option value="150">150</option>
                                <option value="200">200</option>
                            </select>
                            Max multi match size
                        </p>
                        <p>
                            <select id="latency">
                                <option value="50">50 ms</option>
                                <option value="200" selected="selected">200 ms</option>
                                <option value="500">500 ms</option>
                                <option value="1000">1000 ms</option>
                                <option value="2000">2000 ms</option>
                            </select>
                            Latency before search starts
                        </p>
                        <p>
                            <input type="checkbox" id="exactMatch" value="true" /> Exact match
                        </p>
                        <p>
                            <input type="checkbox" id="wildcards" value="true" checked="checked" /> Wildcard character support (* = any char, ? = one char)
                        </p>
                        <p>
                            <input type="checkbox" id="ignoreCase" value="true" checked="checked" /> Ignore case sensitivity
                        </p>
                        <p>
                            <input type="button" onclick="applyOptions();" value="Apply" />
                        </p>

                        <h2>
                            Modify select object on runtime:
                        </h2>
                        <p>
                            <input type="button" onclick="modifySelect();" value="Change selectedIndex to 5" />
                        </p>
                        <p>
                            Append new option: <input type="text" id="str" value="" /> <input type="button" onclick="appendSelectOption($('#str').val());" value="append" />
                        </p>
                    </form>

                </div>
            </div>
            <!-- end select2 -->

        </div>


    </div>
    <!-- end row -->

    <!-- end row -->

    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Colorpicker</h4>
                    <p class="card-title-desc">Examples of Spectrum Colorpicker.</p>

                    <form action="#">
                        <div class="mb-3">
                            <label class="form-label">Simple input field</label>
                            <input type="text" class="form-control" id="colorpicker-default" value="#50a5f1">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Show Alpha</label>
                            <input type="text" class="form-control" id="colorpicker-showalpha" value="rgba(244, 106, 106, 0.6)">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Show Palette Only</label>
                            <input type="text" class="form-control" id="colorpicker-showpaletteonly" value="#34c38f">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Toggle Palette Only</label>
                            <input type="text" class="form-control" id="colorpicker-togglepaletteonly" value="#50a5f1">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Show Initial</label>
                            <input type="text" class="form-control" id="colorpicker-showintial" value="#f1b44c">
                        </div>
                        <div>
                            <label class="form-label">Show Input And Initial</label>
                            <input type="text" class="form-control" id="colorpicker-showinput-intial" value="#f46a6a">
                        </div>

                    </form>

                </div>
            </div>

            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Bootstrap MaxLength</h4>
                    <p class="card-title-desc">This plugin integrates by default with
                        Twitter bootstrap using badges to display the maximum lenght of the
                        field where the user is inserting text. </p>

                    <label class="mb-1">Default usage</label>
                    <p class="text-muted mb-3 font-14">
                        The badge will show up by default when the remaining chars are 10 or less:
                    </p>
                    <input type="text" class="form-control" maxlength="25" name="defaultconfig" id="defaultconfig">

                    <div class="mt-3">
                        <label class="mb-1">Threshold value</label>
                        <p class="text-muted mb-3 font-14">
                            Do you want the badge to show up when there are 20 chars or less? Use the <code>threshold</code> option:
                        </p>
                        <input type="text" maxlength="25" name="thresholdconfig" class="form-control" id="thresholdconfig">
                    </div>

                    <div class="mt-3">
                        <label class="mb-1">All the options</label>
                        <p class="text-muted mb-3 font-14">
                            Please note: if the <code>alwaysShow</code> option is enabled, the <code>threshold</code> option is ignored.
                        </p>
                        <input type="text" class="form-control" maxlength="25" name="alloptions" id="alloptions">
                    </div>

                    <div class="mt-3">
                        <label class="mb-1">Position</label>
                        <p class="text-muted mb-3 font-14">
                            All you need to do is specify the <code>placement</code> option, with one of those strings. If none
                            is specified, the positioning will be defauted to 'bottom'.
                        </p>
                        <input type="text" class="form-control" maxlength="25" name="placement" id="placement">
                    </div>

                    <div class="mt-3">
                        <label class="mb-1">Textarea</label>
                        <p class="text-muted mb-3 font-14">
                            Bootstrap maxlength supports textarea as well as inputs. Even on old IE.
                        </p>
                        <textarea id="textarea" class="form-control" maxlength="225" rows="3" placeholder="This textarea has a limit of 225 chars."></textarea>
                    </div>

                </div>
            </div>

        </div> <!-- end col -->

        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Datepicker</h4>
                    <p class="card-title-desc">Examples of twitter bootstrap datepicker.</p>

                    <form action="#">
                        <div class="mb-4">
                            <label class="form-label">Default Functionality</label>
                            <div class="input-group" id="datepicker1">
                                <input type="text" class="form-control" placeholder="dd M, yyyy" data-date-format="dd M, yyyy" data-date-container='#datepicker1' data-provide="datepicker">

                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                            </div><!-- input-group -->
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Auto Close</label>
                            <div class="input-group" id="datepicker2">
                                <input type="text" class="form-control" placeholder="dd M, yyyy" data-date-format="dd M, yyyy" data-date-container='#datepicker2' data-provide="datepicker" data-date-autoclose="true">

                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                            </div><!-- input-group -->
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Multiple Date</label>
                            <div class="input-group" id="datepicker3">
                                <input type="text" class="form-control" placeholder="dd M, yyyy" data-provide="datepicker" data-date-container='#datepicker3' data-date-format="dd M, yyyy" data-date-multidate="true">

                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                            </div><!-- input-group -->
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Month View</label>
                            <div class="position-relative" id="datepicker4">
                                <input type="text" class="form-control" data-date-container='#datepicker4' data-provide="datepicker" data-date-format="MM yyyy" data-date-min-view-mode="1">
                            </div>

                        </div>

                        <div class="mb-4">
                            <label class="form-label">Year View</label>
                            <div class="position-relative" id="datepicker5">
                                <input type="text" class="form-control" data-provide="datepicker" data-date-container='#datepicker5' data-date-format="dd M, yyyy" data-date-min-view-mode="2">
                            </div>
                        </div>

                        <div>
                            <label class="form-label">Date Range</label>

                            <div class="input-daterange input-group" id="datepicker6" data-date-format="dd M, yyyy" data-date-autoclose="true" data-provide="datepicker" data-date-container='#datepicker6'>
                                <input type="text" class="form-control" name="start" placeholder="Start Date" />
                                <input type="text" class="form-control" name="end" placeholder="End Date" />
                            </div>
                        </div>

                    </form>
                </div>
            </div>


            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Bootstrap TouchSpin</h4>
                    <p class="card-title-desc">A mobile and touch friendly input spinner component for Bootstrap</p>

                    <form>
                        <div class="mb-3">
                            <label class="form-label">Using data attributes</label>
                            <input id="demo0" type="text" value="55" name="demo0" data-bts-min="0" data-bts-max="100" data-bts-init-val="" data-bts-step="1" data-bts-decimal="0" data-bts-step-interval="100" data-bts-force-step-divisibility="round" data-bts-step-interval-delay="500" data-bts-prefix="" data-bts-postfix="" data-bts-prefix-extra-class="" data-bts-postfix-extra-class="" data-bts-booster="true" data-bts-boostat="10" data-bts-max-boosted-step="false" data-bts-mousewheel="true" data-bts-button-down-class="btn btn-default" data-bts-button-up-class="btn btn-default">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Example with postfix (large)</label>
                            <input id="demo1" type="text" value="55" name="demo1">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">With prefix </label>
                            <input id="demo2" type="text" value="0" name="demo2" class=" form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Init with empty value:</label>
                            <input id="demo3" type="text" value="" name="demo3">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Value attribute is not set (applying settings.initval)</label>
                            <input id="demo3_21" type="text" value="" name="demo3_21">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Value is set explicitly to 33 (skipping settings.initval) </label>
                            <input id="demo3_22" type="text" value="33" name="demo3_22">
                        </div>

                        <div>
                            <label class="form-label">Vertical button alignment:</label>
                            <input id="demo_vertical" type="text" value="" name="demo_vertical">
                        </div>

                    </form>

                </div>
            </div>

        </div> <!-- end col -->
    </div> <!-- end row -->


    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Css Switch</h4>
                    <p class="card-title-desc">Here are a few types of switches. </p>

                    <div class="row">
                        <div class="col-lg-6">
                            <h5 class="font-size-14 mb-3">Example switch</h5>
                            <div class="d-flex flex-wrap gap-2">
                                <input type="checkbox" id="switch1" switch="none" checked />
                                <label for="switch1" data-on-label="On" data-off-label="Off"></label>

                                <input type="checkbox" id="switch2" switch="default" checked />
                                <label for="switch2" data-on-label="" data-off-label=""></label>

                                <input type="checkbox" id="switch3" switch="bool" checked />
                                <label for="switch3" data-on-label="Yes" data-off-label="No"></label>

                                <input type="checkbox" id="switch6" switch="primary" checked />
                                <label for="switch6" data-on-label="Yes" data-off-label="No"></label>

                                <input type="checkbox" id="switch4" switch="success" checked />
                                <label for="switch4" data-on-label="Yes" data-off-label="No"></label>

                                <input type="checkbox" id="switch7" switch="info" checked />
                                <label for="switch7" data-on-label="Yes" data-off-label="No"></label>

                                <input type="checkbox" id="switch5" switch="warning" checked />
                                <label for="switch5" data-on-label="Yes" data-off-label="No"></label>

                                <input type="checkbox" id="switch8" switch="danger" checked />
                                <label for="switch8" data-on-label="Yes" data-off-label="No"></label>

                                <input type="checkbox" id="switch9" switch="dark" checked />
                                <label for="switch9" data-on-label="Yes" data-off-label="No"></label>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="mt-4 mt-lg-0">
                                <h5 class="font-size-14 mb-3">Square switch</h5>
                                <div class="d-flex flex-wrap gap-2">
                                    <div class="square-switch">
                                        <input type="checkbox" id="square-switch1" switch="none" checked />
                                        <label for="square-switch1" data-on-label="On" data-off-label="Off"></label>
                                    </div>
                                    <div class="square-switch">
                                        <input type="checkbox" id="square-switch2" switch="info" checked />
                                        <label for="square-switch2" data-on-label="Yes" data-off-label="No"></label>
                                    </div>
                                    <div class="square-switch">
                                        <input type="checkbox" id="square-switch3" switch="bool" checked />
                                        <label for="square-switch3" data-on-label="Yes" data-off-label="No"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->

</div> <!-- container-fluid -->


<?= $this->section('javascript'); ?>

<!-- 
<script src="<?= base_url(); ?>assets/js/pages/form-advanced.init.js"></script>

<script src="<?= base_url(); ?>assets/js/app.js"></script>

<script src="<?= base_url(); ?>assets/libs/select2/js/select2.min.js"></script>
<script src="<?= base_url(); ?>assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="<?= base_url(); ?>assets/libs/spectrum-colorpicker2/spectrum.min.js"></script>
<script src="<?= base_url(); ?>assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
<script src="<?= base_url(); ?>assets/libs/admin-resources/bootstrap-filestyle/bootstrap-filestyle.min.js"></script>
<script src="<?= base_url(); ?>assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
<script src="<?= base_url(); ?>assets/libs/jquery/jquery.min.js"></script>
<script src="<?= base_url(); ?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url(); ?>assets/libs/metismenu/metisMenu.min.js"></script>
<script src="<?= base_url(); ?>assets/libs/simplebar/simplebar.min.js"></script>
<script src="<?= base_url(); ?>assets/libs/node-waves/waves.min.js"></script>
 -->

<!-- BEGIN syntax highlighter jqsearchable-->
<script type="text/javascript" src="<?= base_url(); ?>jqsearchable/sh/shCore.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>jqsearchable/sh/shBrushJScript.js"></script>
<link type="text/css" rel="stylesheet" href="<?= base_url(); ?>jqsearchable/sh/shCore.css" />
<link type="text/css" rel="stylesheet" href="<?= base_url(); ?>jqsearchable/sh/shThemeDefault.css" />
<script type="text/javascript">
    SyntaxHighlighter.all();
</script>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>jqsearchable/jquery.searchabledropdown-1.0.8.min.js"></script>

<!-- END syntax highlighter -->

<?= $this->endSection(); ?>

<?= $this->endSection(); ?>