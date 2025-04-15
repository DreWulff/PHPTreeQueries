<?php
/**
 * Checks if node $Q1 is an ancestor of node $Q2 in a tree represented as an array.
 * @param int $Q1 The ancestor node to check.
 * @param int $Q2 The descendant node to check.
 * @param array $tree The tree represented as an array.
 * @return bool True if $Q1 is an ancestor of $Q2, false otherwise.
 */
function check_query($Q1, $Q2, $tree)
{
    // Check if Q1 and Q2 are within the bounds of the tree array
    if ($Q1 < 0 || $Q1 >= count($tree) || $Q2 < 0 || $Q2 >= count($tree)) {
        return false; // Invalid query
    }

    if ($Q1 == $Q2) {
        return true; // Q1 and Q2 are the same node
    }

    if ($Q1 == 0) {
        return true; // Q1 is the root node, so it is an ancestor of all nodes
    }

    // Check if Q1 is an ancestor of Q2
    while ($Q2 != 0) {
        if ($tree[$Q2] == $Q1) {
            return true; // Q1 is an ancestor of Q2
        }
        $Q2 = $tree[$Q2]; // Move up the tree
    }
    return false; // Q1 is not an ancestor of Q2
}

/**
 * Reads a file containing tree structure and queries, and processes them.
 * The first line contains two integers: n (number of nodes) and Q (number of queries).
 * The next n-1 lines contain two integers each, representing an edge between two nodes.
 * The following Q lines contain two integers each, representing the queries.
 * @param string $filename The name of the file to read.
 * @return void
 */
function create_tree($filename = "input.txt")
{
    // Open the file for reading
    $file = fopen($filename, "r");
    if (!$file) {
        die("Unable to open the file.");
    }
    $line_number = 1; // Track the line number
    $n = 0; // Initialize n to 0
    $Q = 0; // Initialize Q to 0
    $tree = array_fill(0, $n, 0); // Initialize the tree array with zeros
    $tree[0] = 0;
    while (($line = fgets($file)) !== false) {
        // Trim the line to remove extra whitespace
        $line = trim($line);

        // Split the line into two integers
        list($int1, $int2) = explode(" ", $line);

        // Convert to integers
        $int1 = (int)$int1;
        $int2 = (int)$int2;

        if ($line_number === 1) {
            // Logic for odd-numbered lines
            $n = $int1; // Update n with the first integer
            $Q = $int2; // Update Q with the second integer
            $line_number++;
            continue; // Skip to the next iteration
        }

        if ($line_number <= $n)
        {
            $tree[$int2 - 1] = $int1 - 1; // Assign int1 to the tree at index int2 + 1
        }
        else
        {
            if ($line_number > $n + $Q) {
                break; // Stop processing if we have read Q queries
            }
            echo check_query($int1 - 1, $int2 - 1, $tree) ? "YES\n" : "NO\n";
        }
        $line_number++;
    }
    fclose($file);
}

# Example of use:
create_tree();
?>