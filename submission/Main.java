/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package soal.soalilpc;

import java.util.ArrayList;
import java.util.Scanner;

public class Main {

    public static void main(String[] args) {
        Scanner in = new Scanner(System.in);
        //misalkan aku suka programming maka aku mau ikut lomba programming di UBAYA yaitu ILPC 2022
        //3 4 11 4 3 3 4 5 11 2 5 5 4 4
        //E O I O E E O A I U A A O O
        ArrayList<String> listOfJawaban = new ArrayList<String>();
        int banyakInput = Integer.parseInt(in.nextLine());
        while (banyakInput != 0) {
            banyakInput = banyakInput - 1;
            String kalimat = in.nextLine();
            String[] tiapKata = kalimat.split(" ");
            ArrayList<Character> murniKata = new ArrayList<>();
            String passwordKu = "";
            for (int i = 0; i < tiapKata.length; i++) {
                for (char ch : tiapKata[i].toCharArray()) {
                    if (Character.isLetter(ch)) {
                        murniKata.add(ch);
                    }
                }
                if (murniKata.size() % 5 == 0) {
                    passwordKu += "A";
                } else if (murniKata.size() % 5 == 1) {
                    passwordKu += "I";
                } else if (murniKata.size() % 5 == 2) {
                    passwordKu += "U";
                } else if (murniKata.size() % 5 == 3) {
                    passwordKu += "E";
                } else {
                    passwordKu += "O";
                }
                for (char ch : tiapKata[i].toCharArray()) {
                    if (!Character.isLetter(ch)) {
                        passwordKu += ch;
                    }
                }
                murniKata.clear();
            }
            listOfJawaban.add(passwordKu);
        }
        for (String jawaban : listOfJawaban)
        {
            System.out.println(jawaban);
        }

    }
}
