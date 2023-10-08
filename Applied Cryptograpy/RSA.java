import java.math.BigInteger;
// import java.security.*;
// import javax.crypto.*;
import java.util.Scanner;   // bring in library to get input from user
import  java.util.Random;   // bring in library to use random number
import java.util.ArrayList; // bring in library to use array list

import javax.swing.*;
import java.awt.*;       // bring in library to use GUI
import java.awt.event.*;

public class RSA extends JFrame implements ActionListener{
    
    String text ;
    JPanel panel;
    JLabel label;
    JTextField tf;
    JButton send;
    JButton reset;
    JTextArea ta;
    JScrollPane scrollableTextArea;  

    boolean result = false;
    BigInteger e,d,p,q,n,tempP,tempQ,phiN;
    
    /** Encrypt the given plain-text message. */
    static ArrayList<String> encrypt(String message,BigInteger e, BigInteger n) {
        ArrayList<String> arr = new ArrayList<>();
        //get the length of cutting place
        int i = 0;
        //get overall message length
        int length = message.getBytes().length;
        //get number of looping needed to break the long string text
        int numberOfLooping = length/128;
        //checking if message length is lesser than 128
        if(length <= 128){
            //perform one-shot encryption as 512 bit keys allow up to maximum 128 length word
            arr.add(new BigInteger(message.getBytes()).modPow(e, n).toString());
        }else{
            //breaking a long text into a few block to perform encryption
            for(int j=0;j<=numberOfLooping;j++){
                i = message.indexOf("", 128);
                if (i < 0) {
                    i = message.length();
                }
                //cut a long string into smaller block to be encrypted
                String part = message.substring(0,i).trim();
                //update back the rest of the sentence into the original text
                message = message.substring(i).trim();
                arr.add(new BigInteger(part.getBytes()).modPow(e, n).toString());
            }
        }
        return arr;
    }
    
    /** Decrypt the given cipher-text message. */
    static String decrypt(ArrayList<String> message,BigInteger d, BigInteger n) {
        
        //store the final result
        String result = "";

        for(int num = 0; num<message.size();num++){
            result += new String((new BigInteger(message.get(num))).modPow(d, n).toByteArray());
        }
        return result;   
    }

    // Check the GCD between two numbers
    static boolean bigIntegerRelativelyPrime(BigInteger a, BigInteger b) {
        return a.gcd(b).equals(BigInteger.ONE);
    }

    public RSA(){
        e = BigInteger.valueOf(65537);
        p = q = n = tempP = tempQ = phiN = null;

        while(!result){
            //Generate a 512 bit key pair
            p = BigInteger.probablePrime(512, new Random());
            q = BigInteger.probablePrime(512, new Random());

            //Getting the product of p.q = n
            n = p.multiply(q);

            //Getting the Euler Tolient Function of n
            tempP = p.subtract(BigInteger.ONE); 
            tempQ = q.subtract(BigInteger.ONE);
            phiN = tempP.multiply(tempQ);

            //Checking relative prime between two numbers
            result = bigIntegerRelativelyPrime(phiN, e);
        }

        //Getting multiplicative inverse of e
        //Getting decryption key
        d = e.modInverse(phiN);
        
       //Creating the Frame
       JFrame frame = new JFrame("RSA Encryption");
       frame.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
       frame.setSize(1000, 600);

       //Creating the panel at top and adding components
       panel = new JPanel(); // the panel is not visible in output
       label = new JLabel("Enter Text");
       tf = new JTextField(50); // accepts upto 10 characters
       send = new JButton("Send");
       reset = new JButton("Reset");

       ta = new JTextArea();
       ta.setLineWrap (true);
       Font font = new Font("Comic Sans MS", Font.BOLD, 14);
       ta.setFont(font);

       scrollableTextArea = new JScrollPane(ta);
       
       send.addActionListener(this);
       reset.addActionListener(this);

       panel.add(label); // Components Added using Flow Layout
       panel.add(tf);
       panel.add(send);
       panel.add(reset);

       ta. setEditable(false);

       //Adding Components to the frame.
       frame.getContentPane().add(BorderLayout.NORTH, panel);
       frame.getContentPane().add(BorderLayout.CENTER, ta);
       frame.setVisible(true);
    }

    public void actionPerformed(ActionEvent ae)
    {
        if (ae.getSource() == send) {
            text = tf.getText(); //perform your operation
            try{

            //if text field is empty
            if(text.equals("")){
                ta.setForeground(Color.RED);
                ta.setText("Please insert some text");
            }else{//if text field is not empty
                

                ta.setForeground(Color.BLUE);
                //Perform encryption
                ArrayList<String> enMsg = encrypt(text,e,n);
                
                //Perform decryption
                String deMsg = decrypt(enMsg,d,n);

                ta.setText("P:"+p+"\n\n");
                ta.append("Q:"+q+"\n\n");
                ta.append("N:"+n+"\n\n");
                ta.append("e:"+e+"\n\n");
                ta.append("phiN:"+phiN+"\n\n");
                ta.append("d:"+d+"\n\n");
                ta.append("Encrypted Message:"+enMsg+"\n\n");
                ta.append("Decrypted Message:"+deMsg+"\n\n");
            }
        }catch(Exception e){
            e.printStackTrace();
        }

        }else if(ae.getSource() == reset){
            tf.setText("");
        }
    }
    

    public static void main(String[]args){
        RSA rsa = new RSA();
    }
}