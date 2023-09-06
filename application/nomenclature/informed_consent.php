<?php require_once("header.php"); ?>
    <h3 style="color:red" align="center"><b><u>Do not use your browser navigation controls.</u></b></h3>
    <div class="container-fluid">
      <div>
        <h1>Informed Consent Form</h1>
        <h3>TITLE OF STUDY: TOWARD DATA SCIENCE FOR ALL</h3>
        <h3>INVESTIGATOR(S): Dr. Andreas Stefik</h3>
		<h3>                 Dr. Jenna Gorlewicz</h3>
		<h3>                 Dr. Nicholas Giudice</h3>
		<h3>                 Dr. Brianna Blaser</h3>
		<h3>                 Dr. Derrick Smith</h3>
		<p>For questions or concerns about the study, you may contact Dr. Andreas Stefik at <b>XXX-XXX-XXXX.</b></p>
        <p>For questions regarding the rights of research subjects, any complaints or comments regarding the manner in which the study is being conducted, contact <b>the UNLV Office of Research Integrity – Human Subjects at XXX-XXX-XXXX or via email at XXXXX@XXXXX.</b></p>
	  </div>
      
      <div id="scroll-area">
        <h4>Purpose of the Study</h4>
        <p>You are invited to participate in a research study.  The purpose of this study is to study scientific programming languages and tools.</p>
        <h4>Participants</h4>
        <p>You are being asked to participate in the study because you fit this criteria: 18 or older, sighted, blind or visually impaired individual, teacher of the blind or visually impaired, or industry professional.</p>
        <h4>Procedures</h4>
        <p>If you volunteer to participate in this study, you will be asked to do the following: </p>
        <ol>
		  <li>Fill out a demographic survey</li>
          <li>Read descriptions of various statistical tests and concepts</li>
          <li>Make decisions on how well a given word, phrase or method name maps to a statistical test or concept</li>
		  <li>Take a survey about your experiences</li>
        </ol>
        <h4>Benefits of Participation</h4>
        <p>There may not be direct benefits to you as a participant in this study.  However, we hope to learn about how people interact with scientific programming languages and tools.</p>
        <h4>Risks of Participation</h4>
        <p>There are risks involved in all research studies. This study may include only minimal risks. You may experience some mental stress while reading through questions and considering answers. This study is being conduct remotely, and while we do our best to keep all information confidential, no computer security mechanism is perfectly secure.</p>
        <h4>Cost/Compensation</h4>
        <p>There may not be financial cost to you to participate in this study.  The study will take 30-60 minutes of your time.  Compensation will be provided as 2% extra credit in courses where the instructor allowed study advertisement. As an alternative to getting this compensation if you choose not to participate, you may also write a short paper (2 pages) on a topic related to the course. If you are not in a course that offers extra credit, there will be no compensation.</p>
        <h4>Funding</h4>
		<p>This research is funded by the National Science Foundation.</p>
		<h4>Confidentiality</h4>
        <p>All information gathered in this study will be kept as confidential as possible.  No reference will be made in written or oral materials that could link you to this study.  All records will be stored in a locked facility at UNLV for 5 years after completion of the study.  Identifiers might be removed from identifiable private information and, after such removal, the information could be used for future research studies or distributed to another investigator for future research studies without additional informed consent from you.</p>
        <h4>Voluntary Participation</h4>
        <p>Your participation in this study is voluntary. You may refuse to participate in this study or in any part of this study.  You may withdraw at any time without prejudice to your relations with UNLV. You are encouraged to ask questions about this study at the beginning or any time during the research study. Your decision whether or not to participate in this study will not affect your grades or participation in school.</p>
      </div>

      <form role="form" action="code/accept_consent.php" method="post">
        <div class="form-group">
          <h4>Participant Consent</h4>
          <p>I have read the above information and agree to participate in this study.  I have been able to ask questions about the research study.  I am at least 18 years of age.  A copy of this form has been given to me (<a target="_blank" href="documents/InformedConsent.pdf">Informed Consent Form</a>).</p>
		  <p>You will be presented with a button to Accept/Decline at the bottom of the web form. If you click Accept, you will continue to the survey.</p>
		<button type="submit" class="btn btn-success bt-lg">I Accept</button>
        <button type="button" onclick="window.location.href = 'code/decline_consent.php'" class="btn btn-danger bt-lg">I Decline</button>
        </div>
      </form>
    </div>

<?php require_once("footer.php"); ?>
