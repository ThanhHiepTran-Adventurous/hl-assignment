package org.example;

import java.lang.reflect.Array;
import java.util.Arrays;
import java.util.Collections;
import java.util.Scanner;

public class Main {

    static void miniMaxSum(int[] arr) {
        long minSum = 0;
        long maxSum = 0;

        Arrays.sort(arr);

        for(int i = 0; i < arr.length - 1; i++) {
            minSum += arr[i];
        }

        for (int i = 1; i < arr.length; i++) {
            maxSum += arr[i];
        }
        System.out.println(minSum + " " + maxSum);
    }
    public static void main(String[] args) {
        Scanner scanner = new Scanner(System.in);
        int[] arr = new int[5];

        // Input array elements
        for (int i = 0; i < 5; i++) {
            arr[i] = scanner.nextInt();
        }

        // Call miniMaxSum function
        miniMaxSum(arr);

        scanner.close();
    }
}