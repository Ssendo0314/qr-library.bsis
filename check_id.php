<?php
// Include the necessary files for database connection
require_once 'core/init.php';

// Check if the borrowerID is provided in the POST request
if (isset($_POST['borrowerID'])) {
    // Get the borrowerID from the POST request
    $borrowerID = $_POST['borrowerID'];

    // Query the database to count the number of books borrowed by the borrowerID
    $borrowedBooks = DB::getInstance()->query("SELECT COUNT(*) AS count FROM books WHERE borrowerID = ?", array($borrowerID));

    // Check if any results were returned
    if ($borrowedBooks->count()) {
        // Get the count of borrowed books
        $countBorrowedBooks = $borrowedBooks->first()->count;

        // Query the database to fetch the borrower's full name
        $borrower = DB::getInstance()->get('userlogin', array('id', '=', $borrowerID));

        // Check if any results were returned
        if ($borrower->count()) {
            // Get the borrower's full name
            $fullName = $borrower->first()->fname . ' ' . $borrower->first()->lname;
            $borrowerEmail = $borrower->first()->email;

            // Check if the borrower has borrowed 3 or more books
            if ($countBorrowedBooks >= 3) {
                echo json_encode(array('error' => 'Borrower ' . $fullName . ' has borrowed 3 or more books'));
            } else {
                // Query the database to check for overdue books
                $overdueBooks = DB::getInstance()->query("SELECT COUNT(*) AS count FROM books WHERE borrowerID = ? AND (dateBorrowed IS NULL OR dateBorrowed <= DATE_SUB(NOW(), INTERVAL 3 DAY))", array($borrowerID));

                // Check if any overdue books were found
                if ($overdueBooks->first()->count > 0) {
                    echo json_encode(array('error' => 'Borrower ' . $fullName . ' has overdue books'));
                } else {
                    // There are no overdue books, borrower is eligible to borrow books
                    echo json_encode(array('message' => 'Borrower ' . $fullName . ' is eligible to borrow books', 'fullName' => $fullName, 'email' => $borrowerEmail));
                }
            }
        } else {
            // Borrower ID not found
            echo json_encode(array('error' => 'Borrower ID not found'));
        }
    } else {
        // No books borrowed by the borrowerID
        echo json_encode(array('error' => 'No books borrowed by the borrowerID'));
    }
} else {
    // borrowerID not provided in the request
    echo json_encode(array('error' => 'borrowerID not provided'));
}
?>
