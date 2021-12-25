package asset;
import java.util.Scanner;

class Main {
    public static void main(String[] args){
        Scanner sc = new Scanner(System.in);
        int total = sc.nextInt();
        for(int t = 0;t < total;t++){
            int max = sc.nextInt();
            int[] players = new int[max];
            for(int count = 0;count < max;count++){
                players[count] = sc.nextInt();
            }
            int odd = 0, even = 0;
            for(int i:players){
                if(i%2 == 0)
                    even++;
                else
                    odd++;
            }
            
            if(odd > even)
                System.out.println("READY");
            else
                System.out.println("NOT READY");
        }
        sc.close();
    }
}